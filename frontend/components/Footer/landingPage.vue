<template>
  <footer class="footer">
    <div class="container">
      <div class="footer_logoWrapper">
        <NuxtImg src="icons/blpLogo2.png" width="200px" class="footer_logo footer_logo--lp"/>
      </div>

      <div class="row row--alignStart row--gap16">
        <div class="footerColumn">
          <h3 class="footerColumn_title">Kontakt</h3>
          <a href="tel:+48 564 753 193" class="footerColumn_link">+48 56 475 31 93</a>
          <a href="mailto:info@blpaczka.com" class="footerColumn_link">info@blpaczka.com</a>

          <div class="footer_socialMediaWrapper">
            <a href="https://www.facebook.com/profile.php?id=100086448834292" class="footerColumn_link footerColumn_link--img">
              <NuxtImg src="icons/facebookIcon.png" width="40px" height="40px" />
            </a>
            <a href="https://www.linkedin.com/company/blpaczka-by-baselinker/" class="footerColumn_link footerColumn_link--img">
              <NuxtImg src="icons/linkedinIcon.png" width="40px" height="40px" />
            </a>
          </div>
        </div>

        <div class="footerColumn footerColumn--xl">
          <h3 class="footerColumn_title">Czym jest BLPaczka</h3>
          <p class="footerColumn_link">BLPaczka jest częścią Grupy BaseLinker - dostawcy najpopularniejszego w Polsce narzędzia do integracji i zarządzania sprzedażą w e-commerce.</p>
        </div>

        <div class="footerColumn">
          <h3 class="footerColumn_title">Dane firmowe</h3>
          <span class="footerColumn_link">BL Logistics Sp. z o.o.</span>
          <span class="footerColumn_link">ul. Czerska 8/10</span>
          <span class="footerColumn_link">00-732 Warszawa</span>
          <span class="footerColumn_link">NIP: 5213971463</span>
          <span class="footerColumn_link">Regon: 522241892</span>
          <span class="footerColumn_link">KRS: 0000975638</span>
        </div>
      </div>
    </div>
  </footer>
</template>
<script setup lang="ts">
const mainPageUrl = window.location.origin + '/'
</script>