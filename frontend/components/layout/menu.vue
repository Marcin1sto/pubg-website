<script setup lang="ts">
import usePagesStore from "~/stores/usePagesStore";

const {menuItems} = storeToRefs(usePagesStore());

const isMobileMenuOpen = ref(false);

const toggleMobileMenu = () => {
  isMobileMenuOpen.value = !isMobileMenuOpen.value;
  if (isMobileMenuOpen.value) {
    document.body.style.overflow = 'hidden';
  } else {
    document.body.style.overflow = '';
  }
};

const closeMobileMenu = () => {
  isMobileMenuOpen.value = false;
  document.body.style.overflow = '';
};
</script>

<template>
  <!-- scroll-top done -->
  <button class="scroll__top scroll-to-target w-[45px] h-[45px] leading-[45px] fixed bottom-[-10%] text-xl z-[99] text-[#201f2a] text-center cursor-pointer transition-[0.8s] duration-500 rounded-[3px] border-[none] right-[50px] bg-[#45f882] after:absolute after:z-[-1] after:content-[''] after:h-2.5 after:w-[90%] after:opacity-100 after:left-[5%] after:top-full after:bg-[radial-gradient(ellipse_at_center,rgba(0,0,0,0.25)0%,rgba(0,0,0,0)80%)]  hover:text-[#201f2a] hover:bg-[#ffbe18]
     lg:w-10 lg:h-10 lg:leading-10 lg:text-center lg:right-[30px] lg:text-[18px]
     md:w-[35px] md:h-[35px] md:leading-[35px] md:text-center md:right-[25px] md:text-[18px]
     sm:w-[30px] sm:h-[30px] sm:leading-[30px] sm:text-center sm:text-[16px] sm:right-[15px]
     xsm:w-[30px] xsm:h-[30px] xsm:leading-[30px] xsm:text-center xsm:text-[16px] xsm:right-[15px]
    " data-target="html">
    <i class="flaticon-right-arrow -rotate-90"></i>
  </button>
  <!-- scroll-top-end-->

  <!-- header-area done -->
  <header>
    <div id="sticky-header"
         class="tg-header__area transparent-header  fixed w-full z-[9] h-auto left-0 top-0  transition-all duration-[0.4s] ease-[ease] px-0 py-[11px] lg:py-[25px] md:py-[25px] sm:py-[25px] xsm:py-[25px]">
      <div class="container custom-container">
        <div class="flex flex-wrap mx-[-15px]">
          <div class="w-full basis-full relative px-[15px]">
            <div
                class="mobile-nav-toggler relative float-right text-[26px] cursor-pointer leading-none text-[#45f882] hidden lg:block md:block sm:block xsm:block border-[#45f882] mt-[3px] px-2.5 py-[5px] border-2 border-solid" @click="toggleMobileMenu">
              <i class="fas fa-bars"></i></div>
            <div class="tgmenu__wrap">
              <nav class="tgmenu__nav  flex items-center flex-wrap justify-start lg:justify-between md:justify-between">
                <div class="logo flex items-center">
                  <a class="inline-block" href="/">
                    <!--              <img class="max-w-[177px]" src="/public/assets/img/logo/logo.png" alt="Logo">-->
                    <h2 style="font-size: 25px" class="title text-[20px] leading-[0.8] mt-0 mb-[21px] mx-0 font-berlin
                                    drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] wow fadeInUp
                                    md:text-[120px]
                                    lg:text-[94px]
                                    xl:text-[118px]
                        sm:text-[14vw] sm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] sm:mt-0 sm:mb-[21px] sm:mx-0
                        xsm:text-[14vw] xsm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] xsm:mt-0 xsm:mb-[21px] xsm:mx-0
                                    " data-wow-delay=".5s">Grywalnia</h2>
                  </a>
                </div>
                <div class="tgmenu__navbar-wrap tgmenu__main-menu flex grow lg:hidden md:hidden sm:hidden xsm:hidden">
                  <ul class="navigation flex flex-row flex-wrap ml-[122px] mr-auto my-0 p-0 xl:flex xl:ml-[65px]  xl:mr-auto  xl:my-0">

                    <li v-for="(item, key) in menuItems" :key="key"
                        :class="item.isDropdown ?
                         'menu-item-has-children block relative list-none group lg:group-disabled  md:group-disabled  sm:group-disabled xsm:group-disabled' :
                          'block relative list-none group'"
                    >
                      <LayoutMenuElementLink :text="item.title" :href="item.route" v-if="!item.isDropdown"/>
                      <LayoutMenuElementDropdown :text="item.title" :items="item.items" v-if="item.isDropdown"/>
                    </li>

                  </ul>
                </div>
                <div class="tgmenu__action block lg:mr-10 md:mr-10 sm:hidden xsm:hidden">
                </div>
              </nav>
            </div>
            <!-- Mobile Menu  -->
            <div
                class="tgmobile__menu fixed w-[300px] max-w-full h-full z-[99] transition-all duration-[0.3s] ease-[cubic-bezier(0.785,0.135,0.15,0.86)] pr-[30px] rounded-none right-0 top-0" :class="isMobileMenuOpen ? 'translate-x-0' : 'translate-x-[101%]'">
              <nav
                  class="tgmobile__menu-box absolute w-full h-full max-h-full overflow-y-auto overflow-x-hidden z-[5] shadow-[-9px_0_14px_0px_rgba(0,0,0,0.06)] p-0 left-0 top-0 bg-[#0f161b]">
                <div
                    class="close-btn absolute leading-[30px] w-[35px] text-center text-[20px] text-[#45f882] cursor-pointer z-10 transition-all duration-[0.5s] ease-[ease] right-[15px] top-7" @click="closeMobileMenu">
                  <i class="flaticon-swords-in-cross-arrangement"></i></div>
                <div class="nav-logo relative text-left px-[25px] py-[30px] mt-[30px]">
                  <a href="/">
                    <h2 class="title text-[40px] leading-[0.8] mt-0 mb-[21px] mx-0 font-berlin
                                    drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] wow fadeInUp
                                    md:text-[40px]
                                    lg:text-[35px]
                                    xl:text-[40px]
                        sm:text-[30px] sm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] sm:mt-0 sm:mb-[21px] sm:mx-0
                        xsm:text-[25px] xsm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] xsm:mt-0 xsm:mb-[21px] xsm:mx-0
                                    " data-wow-delay=".5s">Grywalnia</h2>
                  </a>
                </div>
                <div class="tgmobile__menu-outer">
                  <ul class="flex flex-col flex-wrap px-[25px] py-[30px]">
                    <li v-for="(item, key) in menuItems" :key="key" class="mb-4">
                      <LayoutMobileMenuElement
                        :text="item.title"
                        :href="item.route"
                        :items="item.items"
                      />
                    </li>
                  </ul>
                </div>
                <div class="social-links">
                  <ul class="list-wrap flex relative text-center items-center justify-center flex-wrap gap-3 pt-[30px] pb-5 px-5 m-0">
                    <li class=" relative block">
                      <a
                        class=" flex items-center justify-center w-10 h-10 relative text-[16px] text-[#fff] transition-all duration-500 ease-[ease] border border-[#22292f] rounded-[3px] border-solid hover:border-[#45f882]  "
                        href="https://discord.com/invite/grywalnia" target="_blank">
                        <i class=" text-[44px] text-[#d8d8d8] transition-all duration-[0.3s] ease-[ease-out] delay-[0s]  group-hover:text-[#68fb9a] flaticon-discord lg:text-[30px] md:text-[30px] sm:text-[30px] xsm:text-[30px]"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
            <div
                class="tgmobile__menu-backdrop fixed w-full h-full z-[2] transition-all duration-700 ease-[ease] right-0 top-0 bg-[rgba(0,0,0,0.5)]" 
                :class="isMobileMenuOpen ? 'opacity-100 visible' : 'opacity-0 invisible'"
                @click="closeMobileMenu">
            </div>
            <!-- End Mobile Menu -->
          </div>
        </div>
      </div>
    </div>

    <!-- header-search -->
    <div
        class="search__popup-wrap fixed h-screen w-full z-[99] mt-[-370px] -translate-y-full transition-all duration-[1500ms] ease-[cubic-bezier(0.86,0,0.07,1)] left-0 top-0 after:content-[''] after:absolute after:w-full after:h-[370px] after:bg-[url(.//public/assets/img/bg/search\_wave.png)] after:bg-no-repeat after:bg-center after:bg-cover after:mt-0 after:left-0 after:top-full">
      <div
          class="search__layer content-[''] absolute h-screen w-full bg-[rgba(15,22,27,0.9)] transition-all duration-[1500ms] ease-[cubic-bezier(0.86,0,0.07,1)] z-[-1] left-0 top-0"></div>
      <div class="search__close absolute text-3xl text-[#45f882] cursor-pointer right-[5%] top-[5%]">
        <span><i class="flaticon-swords-in-cross-arrangement"></i></span>
      </div>
      <div class="search__wrap text-center absolute -translate-y-2/4 top-2/4 inset-x-0">
        <div class="container">
          <div class="flex flex-wrap mx-[-15px]">
            <div class="w-full basis-full relative px-[15px]">
              <h2 class="title text-[47px] font-extrabold uppercase text-[#45f882] tracking-[-1px] mt-0 mb-[70px] mx-0 font-Barlow">
                ... <span class=" text-[#fff] tracking-[5px] drop-shadow-[-2px_2.5px_0px_rgba(69,248,130,0.66)]">Search Here</span>
                ...</h2>
              <div
                  class="search__form relative after:content-[''] after:absolute after:w-0 after:h-0.5 after:transition-all after:duration-[600ms] after:ease-[ease] after:left-0 after:bottom-0 after:bg-[#45f882] focus:after:!bg-[#45f882] ">
                <form action="#">
                  <input type="text" name="search" placeholder="Type keywords here" required class=" block w-full text-center font-medium text-3xl text-[#fff] pt-2.5 pb-5 px-[50px] border-transparent bg-transparent placeholder:text-3xl placeholder:opacity-50
                                    focus:!ring-[none] focus:!border-transparent
                                    ">
                  <button
                      class="search-btn absolute text-[25px] text-[#45f882] -translate-y-2/4 border-0 right-5 top-2/4 bg-transparent">
                    <i class="flaticon-loupe"></i></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- header-search-end -->

    <!-- offCanvas-area -->
    <div
        class="offCanvas__wrap fixed overflow-y-auto w-[485px] translate-x-full h-full block bg-[#0d141b] z-[1020] transition-all duration-[600ms] ease-[cubic-bezier(0.785,0.135,0.15,0.86)] flex flex-col right-0 top-0">
      <div class="offCanvas__body flex flex-col flex-1">
        <div
            class="offCanvas__top flex items-center pt-[35px] pb-[25px] px-10 border-b-[#18202a] border-b border-solid">
          <div class="offCanvas__logo logo">
            <a class="inline-block" href="/">
              <!--              <img class="max-w-[177px]" src="/public/assets/img/logo/logo.png" alt="Logo">-->
              <h2 class="title text-[150px] leading-[0.8] mt-0 mb-[21px] mx-0 font-berlin
                                    drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] wow fadeInUp
                                    md:text-[120px]
                                    lg:text-[94px]
                                    xl:text-[118px]
                        sm:text-[14vw] sm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] sm:mt-0 sm:mb-[21px] sm:mx-0
                        xsm:text-[14vw] xsm:drop-shadow-[-1px_5px_0px_rgba(69,248,130,0.66)] xsm:mt-0 xsm:mb-[21px] xsm:mx-0
                                    " data-wow-delay=".5s">Grywalnia</h2>
            </a>
          </div>
          <div
              class="offCanvas__toggle w-[50px] h-[50px] flex items-center justify-center text-[20px] text-[#adb0bc] cursor-pointer transition-all duration-[0.3s] ease-[ease-out] delay-[0s] ml-auto rounded-[50%] hover:text-[#0f161b] hover:bg-[#45f882] ">
            <i class="flaticon-swords-in-cross-arrangement"></i>
          </div>
        </div>
        <div class="offCanvas__content pt-[25px] pb-[50px] px-10">
          <h2 class="title text-3xl tracking-[1px] mt-0 mb-[50px] mx-0">Best Seller of Month Ideas for <span
              class=" text-[#45f882]">NFT Wallet</span></h2>
          <div class="offCanvas__contact mt-0 mb-10 mx-0">
            <h4 class="small-title text-[16px] tracking-[0.5px] font-semibold mt-0 mb-[22px] mx-0">CONTACT US</h4>
            <ul class="offCanvas__contact-list list-wrap m-0 p-0 ">
              <li class=" text-[#adb0bc] font-medium relative mt-0 mb-2 mx-0 pl-[23px] before:content-[''] before:absolute before:w-[7px] before:h-[7px] before:transition-all before:duration-[0.3s] before:ease-[ease-out] before:delay-[0s] before:left-0 before:top-[11px] last:m-0 font-Barlow before:bg-[#adb0bc] hover::before:bg-[#45f882]">
                <a class=" text-[#adb0bc] hover:text-[#45f882]" href="tel:93332225557">+9 333 222 5557</a></li>
              <li class=" text-[#adb0bc] font-medium relative mt-0 mb-2 mx-0 pl-[23px] before:content-[''] before:absolute before:w-[7px] before:h-[7px] before:transition-all before:duration-[0.3s] before:ease-[ease-out] before:delay-[0s] before:left-0 before:top-[11px] last:m-0 font-Barlow before:bg-[#adb0bc] hover::before:bg-[#45f882]">
                <a class=" text-[#adb0bc] hover:text-[#45f882]" href="mailto:info@webmail.com">info@webmail.com</a></li>
              <li class=" text-[#adb0bc] font-medium relative mt-0 mb-2 mx-0 pl-[23px] before:content-[''] before:absolute before:w-[7px] before:h-[7px] before:transition-all before:duration-[0.3s] before:ease-[ease-out] before:delay-[0s] before:left-0 before:top-[11px] last:m-0 font-Barlow before:bg-[#adb0bc] hover::before:bg-[#45f882]">
                New Central Park W7 Street ,New York
              </li>
            </ul>
          </div>
          <div class="offCanvas__newsletter">
            <h4 class="small-title text-[16px] tracking-[0.5px] font-semibold text-[#45f882] mt-0 mb-[22px] mx-0">
              Subscribe</h4>
            <form action="#" class="offCanvas__newsletter-form relative mt-0 mb-5 mx-0">
              <input type="email" placeholder="Get News & Updates"
                     class="block w-full border text-[14px] font-medium transition-all duration-[0.3s] ease-[ease-out] delay-[0s] pl-[22px] pr-20 py-[15px] border-solid border-[#202b36] font-Barlow bg-transparent  focus:!ring-[none] focus:!border-[#535d68] focus:border-solid focus:!outline-offset-0  focus:outline-0">
              <button type="submit" class=" absolute w-[60px] text-[22px] border-[none] right-0 inset-y-0
                            bg-transparent before:content-[''] before:absolute before:w-px before:left-0 before:inset-y-1.5 before:bg-[#202b36] group">
                <i class="flaticon-send group-hover:text-[#ffbe18]"></i></button>
            </form>
            <p class=" text-[14px] font-medium m-0">Subscribe dolor sitamet, consectetur adiping eli. Duis esollici
              tudin augue.</p>
          </div>
          <ul class="offCanvas__social list-wrap m-0 p-0  flex items-center flex-wrap gap-[10px_28px] mt-[50px] mb-0 mx-0 pt-[30px] pb-0 px-0 border-t-[#202b36] border-t border-solid">
            <li class=" leading-none"><a class=" block text-[16px] text-[#fff] hover:text-[#45f882]" href="#"><i
                class="fab fa-twitter"></i></a></li>
            <li class=" leading-none"><a class=" block text-[16px] text-[#fff] hover:text-[#45f882]" href="#"><i
                class="fab fa-facebook-f"></i></a></li>
            <li class=" leading-none"><a class=" block text-[16px] text-[#fff] hover:text-[#45f882]" href="#"><i
                class="fab fa-linkedin-in"></i></a></li>
            <li class=" leading-none"><a class=" block text-[16px] text-[#fff] hover:text-[#45f882]" href="#"><i
                class="fab fa-youtube"></i></a></li>
          </ul>
        </div>
        <div class="offCanvas__copyright mt-auto mb-0 mx-0 px-10 py-[30px] bg-[#090f16]">
          <p class=" text-[14px] uppercase font-semibold tracking-[1px] m-0 font-Barlow">Copyright © 2025 - by Grywalnia</p>
        </div>
      </div>
    </div>
    <div
        class="offCanvas__overlay fixed w-full h-full z-[99] transition-all duration-700 ease-[ease] opacity-0 invisible cursor-none right-0 top-0 bg-[#111922]"></div>
    <!-- offCanvas-area-end -->

  </header>
  <!-- header-area-end -->
</template>

<style scoped lang="css">

</style>