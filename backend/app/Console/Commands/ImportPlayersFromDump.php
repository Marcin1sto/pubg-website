<?php

namespace App\Console\Commands;

use App\Models\Player;
use App\Models\Game;
use App\Models\GamePlayer;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportPlayersFromDump extends Command
{
    protected $signature = 'players:import-from-dump';
    protected $description = 'Importuje graczy z pliku dump/players.sql do nowej struktury danych';

    public function handle()
    {
        $this->info('Rozpoczynam import graczy...');

        try {
            // Znajdź grę PUBG
            $game = Game::where('slug', 'pubg')->firstOrFail();

            // Wczytaj zawartość pliku SQL
            $content = file_get_contents(base_path('app/Console/Commands/dump/players.sql'));

            // Wyciągamy wartości z INSERT statement
            if (preg_match("/INSERT INTO `players` \(`id`, `created_at`, `updated_at`, `deleted_at`, `playerId`, `playerName`, `clanId`, `matchesUpdate`, `seasonUpdate`, `rankingUpdate`\) VALUES\s*(.*?);/s", $content, $match)) {
                // Wyciągamy wszystkie wiersze z wartościami
                preg_match_all("/\((.*?)\)/s", $match[1], $matches);
                
                $this->info("Znaleziono " . count($matches[1]) . " wierszy do importu");
                
                if (empty($matches[1])) {
                    $this->error('Nie znaleziono danych do importu.');
                    return;
                }

                // Debugowanie pierwszego wiersza
                $firstRow = str_getcsv(trim($matches[1][0]), ',', "'");
                $this->info("Przykładowy wiersz:");
                $this->info("ID: " . ($firstRow[0] ?? 'brak'));
                $this->info("PlayerID: " . ($firstRow[4] ?? 'brak'));
                $this->info("PlayerName: " . ($firstRow[5] ?? 'brak'));

                DB::beginTransaction();
                
                try {
                    // Dla każdego znalezionego wiersza
                    foreach ($matches[1] as $values) {
                        // Rozbijamy na poszczególne wartości, zachowując puste stringi
                        $data = str_getcsv(trim($values), ',', "'");
                        
                        // Sprawdzamy czy mamy wszystkie potrzebne dane
                        if (count($data) < 10) {
                            $this->warn("Pominięto nieprawidłowy wiersz: " . $values);
                            continue;
                        }

                        try {
                            // Sprawdź czy gracz już istnieje
                            $player = Player::where('display_name', $data[5])->first();

                            if (!$player) {
                                // Jeśli nie istnieje, utwórz nowego gracza
                                $player = Player::create([
                                    'display_name' => $data[5], // playerName
                                ]);
                                $this->info("Utworzono nowego gracza: " . $data[5]);
                            } else {
                                $this->info("Znaleziono istniejącego gracza: " . $data[5]);
                            }

                            // Sprawdź czy powiązanie już istnieje
                            $existingGamePlayer = $player->games()
                                ->where('game_id', $game->id)
                                ->where('api_player_id', $data[4])
                                ->exists();

                            if (!$existingGamePlayer) {
                                // Dodaj powiązanie przez relację pivot tylko jeśli nie istnieje
                                $player->games()->attach($game->id, [
                                    'api_player_id' => $data[4], // playerId
                                    'platform' => 'steam',
                                    'is_active' => true
                                ]);
                                $this->info("Dodano powiązanie dla gracza: " . $data[5]);
                            } else {
                                $this->info("Powiązanie już istnieje dla gracza: " . $data[5]);
                            }

                        } catch (\Exception $e) {
                            $this->error("Błąd podczas importowania gracza {$data[5]}: " . $e->getMessage());
                            continue;
                        }
                    }
                    
                    DB::commit();
                    $this->info('Import zakończony pomyślnie!');
                } catch (\Exception $e) {
                    DB::rollBack();
                    throw $e;
                }
            } else {
                $this->error('Nie znaleziono INSERT statement w pliku SQL.');
                return 1;
            }

            return 0;
        } catch (\Exception $e) {
            $this->error('Wystąpił błąd podczas importu: ' . $e->getMessage());
            return 1;
        }
    }
}
