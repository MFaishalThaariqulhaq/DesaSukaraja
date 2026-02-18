import { animate, stagger } from 'animejs';

const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

const runOnReady = (fn) => {
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', fn, { once: true });
    return;
  }
  fn();
};

const initPageReveal = () => {
  const items = Array.from(document.querySelectorAll('[data-pg-reveal]'));
  if (!items.length || reduceMotion) {
    items.forEach((item) => {
      item.style.opacity = '1';
      item.style.transform = 'none';
    });
    return;
  }

  items.forEach((item) => {
    item.style.opacity = '0';
    item.style.transform = 'translateY(12px)';
  });

  animate(items, {
    opacity: [0, 1],
    y: [12, 0],
    duration: 520,
    delay: stagger(80),
    ease: 'out(3)',
  });
};

const initTimelineReveal = () => {
  const timeline = document.querySelector('[data-pg-timeline]');
  if (!timeline) return;

  const steps = Array.from(timeline.querySelectorAll('[data-pg-step]'));
  if (!steps.length || reduceMotion) {
    steps.forEach((step) => {
      step.style.opacity = '1';
      step.style.transform = 'none';
    });
    return;
  }

  steps.forEach((step) => {
    step.style.opacity = '0';
    step.style.transform = 'translateY(8px)';
  });

  const observer = new IntersectionObserver(
    (entries, ob) => {
      const visible = entries.some((entry) => entry.isIntersecting);
      if (!visible) return;

      animate(steps, {
        opacity: [0, 1],
        y: [8, 0],
        duration: 460,
        delay: stagger(90),
        ease: 'out(2)',
      });

      ob.disconnect();
    },
    { threshold: 0.22 }
  );

  observer.observe(timeline);
};

const initStatusPulse = () => {
  const liveBadges = Array.from(document.querySelectorAll('.pg-status-badge[data-live="1"]'));
  if (!liveBadges.length || reduceMotion) return;

  liveBadges.forEach((badge) => {
    animate(badge, {
      scale: [1, 1.03, 1],
      duration: 1100,
      loop: 2,
      ease: 'inOut(2)',
    });
  });
};

runOnReady(() => {
  initPageReveal();
  initTimelineReveal();
  initStatusPulse();
});
