document.addEventListener("DOMContentLoaded", () => {
  // ── Mobile Menu Toggle ──
  const hamburgerBtn = document.getElementById('hamburger-btn');
  const mobileMenu = document.getElementById('mobile-menu');

  if (hamburgerBtn && mobileMenu) {
    hamburgerBtn.addEventListener('click', () => {
      mobileMenu.classList.toggle('open');
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
        if (category === 'Toon Alles' || card.getAttribute('data-category') === category) {
          card.style.display = 'flex';
        } else {
          card.style.display = 'none';
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

    // About Section Parallax – Image moving inside frame
    gsap.to("#about-img-left", {
      y: isMobile ? "-15%" : -100,
      ease: "none",
      scrollTrigger: {
        trigger: "#about",
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      }
    });

    gsap.to("#about-img-right", {
      y: isMobile ? "15%" : 100,
      ease: "none",
      scrollTrigger: {
        trigger: "#about",
        start: "top bottom",
        end: "bottom top",
        scrub: true,
      }
    });
  }
});
