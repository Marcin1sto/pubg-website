<?php

namespace App\Http\Controllers\API;

use App\Enums\GamesEnum;
use App\Helpers\CalculatorHelper;
use App\Http\Controllers\Controller;
use App\Models\Player;
use App\Models\PlayerMatchStatistic;
use App\Services\PlayerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiPlayerController extends Controller
{
    /**
     * @param string $nickName
     * @return JsonResponse
     */
    public function verification(string $nickName): JsonResponse
    {
        $player = PlayerService::createPlayer($nickName);

        return response()->json([
            'correct' => !!$player,
            'data' => $player?->toArray(),
            'msg' => !$player ? 'Nie istnieje gracz z takim nickname!' : 'Zostałeś poprawnie zweryfikowany.'
        ]);
    }

    /**
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $player = Player::with(['games' => function($query) {
            $query->select('games.*')
                  ->withPivot(['platform', 'is_active']);
        }])->find($id);

        if (!$player) {
            return response()->json([
                'correct' => false,
                'message' => 'Nie znaleziono gracza'
            ], 404);
        }

        return response()->json([
            'correct' => true,
            'data' => $player
        ]);
    }

    public function getPlayersByGame(?string $game = null)
    {
        if ($game && !in_array($game, GamesEnum::values())) {
            return response()->json([
                'correct' => false,
                'msg' => 'Niepoprawna nazwa gry!'
            ]);
        }

        $players = Player::all();

        return response()->json([
            'correct' => !!$players,
            'data' => $players?->toArray(),
        ]);
    }

    public function index(Request $request): JsonResponse
    {
        $perPage = $request->input('per_page', 10);
        $page = $request->input('page', 1);

        $players = Player::with(['games' => function($query) {
            $query->select('games.*')
                  ->withPivot(['platform', 'is_active']);
        }])
        ->paginate($perPage);

        return response()->json([
            'correct' => true,
            'data' => $players->items(),
            'meta' => [
                'current_page' => $players->currentPage(),
                'from' => $players->firstItem(),
                'last_page' => $players->lastPage(),
                'per_page' => $players->perPage(),
                'to' => $players->lastItem(),
                'total' => $players->total(),
            ],
            'links' => [
                'first' => $players->url(1),
                'last' => $players->url($players->lastPage()),
                'prev' => $players->previousPageUrl(),
                'next' => $players->nextPageUrl(),
            ]
        ]);
    }

    public function getPlayerGameStats(int $playerId, string $game): JsonResponse
    {
        try {
            \Log::info('Pobieranie statystyk gracza', [
                'playerId' => $playerId,
                'game' => $game
            ]);

            $player = Player::with(['games' => function($query) use ($game) {
                $query->where('slug', $game)
                      ->select('games.*')
                      ->withPivot(['platform', 'is_active']);
            }])->find($playerId);

            \Log::info('Znaleziony gracz', [
                'player' => $player ? $player->toArray() : null
            ]);

            if (!$player) {
                return response()->json([
                    'correct' => false,
                    'message' => 'Nie znaleziono gracza'
                ], 404);
            }

//            dd($player);
            // Sprawdź czy gracz ma dostęp do wybranej gry
            $playerGame = $player->games->first();
            \Log::info('Znaleziona gra gracza', [
                'game' => $playerGame ? $playerGame->toArray() : null
            ]);

            if (!$playerGame) {
                return response()->json([
                    'correct' => false,
                    'message' => 'Gracz nie ma dostępu do tej gry'
                ], 404);
            }

            $matches = PlayerMatchStatistic::where('player_id', $playerId)
                ->orderByDesc('played_at')
                ->take(5)
                ->get();


            $stats = [
                'kd' => CalculatorHelper::calculateKdFromMatches($matches),
                'winRate' => CalculatorHelper::calculatePercentWinsFromMatches($matches),
                'matches' => count($matches),
            ];

            $stats['recentMatches'] = $matches;

            return response()->json([
                'correct' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            dd($e);
            \Log::error('Błąd w getPlayerGameStats: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'correct' => false,
                'message' => 'Wystąpił błąd podczas pobierania statystyk'
            ], 500);
        }
    }
}
