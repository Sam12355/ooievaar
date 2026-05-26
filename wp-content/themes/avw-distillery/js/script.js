// ── Inject carousel CSS fix (bypasses page cache) ──
(function() {
    var s = document.createElement('style');
    s.textContent = [
        '.swiper-button-next::after,.swiper-button-prev::after{display:none!important;content:""!important}',
        '.related-carousel-wrapper h4{font-size:18px!important;letter-spacing:.06em!important;word-break:break-word!important}',
        '@media(min-width:640px){.related-carousel-wrapper h4{font-size:22px!important;letter-spacing:.15em!important}}'
    ].join('');
    document.head.appendChild(s);
})();

document.addEventListener("DOMContentLoaded", () => {
  // ── Mobile Menu Toggle ──
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (hamburgerBtn && mobileMenu) {
    hamburgerBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
      hamburgerBtn.classList.toggle('open'); // animates bars → X
    });
  }

  // ── Category Filter ──
  const filterButtons = document.querySelectorAll('.category-btn');
  const productCards = document.querySelectorAll('.product-card');

  filterButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      // 1. Remove active state from all buttons
      filterButtons.forEach(b => {
        b.classList.remove('bg-[#eedfcb]', 'text-[#031509]');
        b.classList.add('text-black', 'hover:bg-[#eedfcb]/50');
      });
      // 2. Add active state to clicked button
      btn.classList.add('bg-[#eedfcb]', 'text-[#031509]');
      btn.classList.remove('text-black', 'hover:bg-[#eedfcb]/50');

      const category = btn.getAttribute('data-category');

      // 3. Filter products
      productCards.forEach(card => {
        if (category === 'Toon Alles') {
          card.style.display = 'flex';
        } else {
          const cardCategories = card.getAttribute('data-category');
          if (cardCategories) {
            const catArray = cardCategories.split(',').map(c => c.trim());
            if (catArray.includes(category)) {
              card.style.display = 'flex';
            } else {
              card.style.display = 'none';
            }
          } else {
            card.style.display = 'none';
          }
        }
      });
    });
  });

  // ── Smooth Scroll (Lenis) ──
  if (typeof Lenis !== 'undefined') {
    const lenis = new Lenis();

    lenis.on('scroll', ScrollTrigger.update);

    gsap.ticker.add((time) => {
      lenis.raf(time * 1000);
    });

    gsap.ticker.lagSmoothing(0);
  }

  // ── GSAP Parallax (desktop only for performance) ──
  if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
    gsap.registerPlugin(ScrollTrigger);

    const isMobile = window.innerWidth < 768;

    // Hero Logo – flies UP very slowly
    gsap.to("#hero-logo", {
      y: isMobile ? -50 : -100,
      opacity: 0,
      ease: "none",
      scrollTrigger: {
        trigger: "#hero",
        start: "top top",
        end: "bottom top",
        scrub: true,
      }
    });

    // Hero Text Set – flies DOWN
    gsap.to("#hero-text-set", {
      y: isMobile ? 200 : 500,
      opacity: 0,
      ease: "none",
      scrollTrigger: {
        trigger: "#hero",
        start: "top top",
        end: "bottom top",
        scrub: true,
      }
    });

    if (isMobile) {
      // Mobile: image slides inside fixed frame
      gsap.to("#about-img-left-mobile", {
        y: "-20%",
        ease: "none",
        scrollTrigger: {
          trigger: "#about",
          start: "top bottom",
          end: "bottom top",
          scrub: 0.5,
        }
      });

      gsap.to("#about-img-right-mobile", {
        y: "-20%",
        ease: "none",
        scrollTrigger: {
          trigger: "#about",
          start: "top bottom",
          end: "bottom top",
          scrub: 0.5,
        }
      });
    } else {
      // Desktop: original dramatic staggered movement
      gsap.to("#about-img-left", {
        y: -250,
        ease: "none",
        scrollTrigger: {
          trigger: "#about",
          start: "top bottom",
          end: "bottom top",
          scrub: 1.5,
        }
      });

      gsap.to("#about-img-right", {
        y: 250,
        ease: "none",
        scrollTrigger: {
          trigger: "#about",
          start: "top bottom",
          end: "bottom top",
          scrub: 1.5,
        }
      });
    }
  }

  // ── Related Products Carousel ──
  var relatedEl = document.querySelector('.related-swiper');
  if (relatedEl && typeof Swiper !== 'undefined') {
    var nextEl = document.querySelector('.avw-swiper-next') || document.querySelector('.swiper-button-next');
    var prevEl = document.querySelector('.avw-swiper-prev') || document.querySelector('.swiper-button-prev');
    new Swiper('.related-swiper', {
      slidesPerView: 1,
      spaceBetween: 16,
      loop: true,
      autoplay: { delay: 3500, disableOnInteraction: false },
      navigation: (nextEl && prevEl) ? { nextEl: nextEl, prevEl: prevEl } : false,
      breakpoints: {
        480:  { slidesPerView: 1.5, spaceBetween: 16 },
        640:  { slidesPerView: 2.2, spaceBetween: 16 },
        1024: { slidesPerView: 3,   spaceBetween: 20 }
      }
    });
  }
});
