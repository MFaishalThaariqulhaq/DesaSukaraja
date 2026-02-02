# Troubleshooting Guide - Common Issues After Code Cleanup

**For:** DesaSukaraja Project Code Refactoring

---

## 🔍 Quick Diagnosis Flow

```
Is anything broken?
├─ CSS not showing?
│  ├─ Check: Browser DevTools > Elements > Styles
│  ├─ Run: npm run build
│  └─ See: "CSS Issues" section below
│
├─ JavaScript not working?
│  ├─ Check: Browser Console for errors
│  ├─ Check: Network tab for 404s
│  └─ See: "JavaScript Issues" section below
│
└─ Page looks weird?
   ├─ Clear browser cache (Ctrl+Shift+Delete)
   ├─ Hard refresh (Ctrl+F5)
   └─ See: "Performance Issues" section below
```

---

## 🎨 CSS Issues & Solutions

### Problem: Styles Not Applied

**Symptoms:**
- Page looks unstyled (no colors, weird layout)
- Tailwind classes not working
- Custom styles from our CSS files missing

**Solutions:**

1. **Check if CSS files are linked**
   ```html
   <!-- Should see these in page source (Right-click > View Page Source) -->
   <link rel="stylesheet" href="/css/layout.css">
   <link rel="stylesheet" href="/css/animations.css">
   <link rel="stylesheet" href="/css/infografis.css"> <!-- if on that page -->
   ```

2. **Rebuild CSS**
   ```bash
   npm run build
   # Then hard refresh browser (Ctrl+Shift+R)
   ```

3. **Check browser DevTools**
   ```javascript
   // Open DevTools (F12) > Console, paste:
   fetch('/css/layout.css')
     .then(r => r.text())
     .then(text => console.log(text.length + ' bytes loaded'))
     .catch(e => console.error('CSS not found:', e));
   ```

4. **Verify asset() helper works**
   ```php
   <!-- Check in blade view source that asset() path is correct -->
   <link rel="stylesheet" href="/build/assets/app-XXX.css">
   <!-- Should NOT be /css/layout.css -->
   ```

---

### Problem: Font Changes Unexpectedly

**Symptoms:**
- Font changes on certain pages
- Header has different font than content
- "Plus Jakarta Sans" showing instead of "Inter"

**Cause:** Font override in page-specific CSS
**Solution:**
```css
/* Check resources/css/infografis.css - should NOT have: */
body {
  font-family: 'Plus Jakarta Sans', sans-serif; /* ❌ Remove this */
}

/* Font should be set in blade via link tag only */
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:..." rel="stylesheet">
```

**Status:** ✅ Already fixed in audit

---

### Problem: Animations Not Working

**Symptoms:**
- Float animation not playing
- Fade in animation missing
- Pulse animation not animating

**Solutions:**

1. **Check if animations.css is linked**
   ```html
   <!-- Should see in page source: -->
   <link rel="stylesheet" href="/build/assets/app-XXX.css">
   ```

2. **Verify @keyframes exist**
   ```bash
   grep -r "@keyframes" resources/css/
   # Should find: float, pulse-soft, fadeIn, fadeInUp, etc
   ```

3. **Check if class is applied**
   ```html
   <!-- Elements should have these classes: -->
   <div class="animate-float"></div>
   <div class="animate-pulse-soft"></div>
   <div class="animate-fadeIn"></div>
   ```

4. **Check reduce-motion preference**
   ```javascript
   // In browser console:
   const prefersReduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
   console.log('User prefers reduced motion:', prefersReduced);
   // If true, animations disabled (this is intentional)
   ```

---

## 🔧 JavaScript Issues & Solutions

### Problem: JavaScript Console Errors

**Symptoms:**
- Red errors in browser console (F12)
- Page doesn't respond to clicks
- Modal doesn't open

**Solutions:**

1. **Read the error message carefully**
   ```javascript
   // Example error: "Cannot read property 'addEventListener' of null"
   // This means element not found - check:
   // 1. Element exists in HTML
   // 2. ID/selector is correct
   // 3. Script runs after DOM loaded
   ```

2. **Check if module is loaded**
   ```javascript
   // In browser console, check:
   console.log(window.initLayout);      // Should be function
   console.log(window.initInfografis);  // Should be function (if page has charts)
   console.log(window.infografisData);  // Should be object (if page has charts)
   ```

3. **Check Network tab**
   ```
   DevTools > Network tab > reload page
   Look for 404s (failed requests):
   ❌ /js/modules/infografis.js (404)
   ✅ Should load from /build/assets/app-XXX.js
   ```

---

### Problem: Module Not Initialized

**Symptoms:**
- Charts not rendering
- Modal not working
- Scroll effect not working

**Cause:** Module not called or data not available

**Solutions:**

1. **Check if module was imported in app-init.js**
   ```javascript
   // Should see in resources/js/app-init.js:
   import { initInfografis } from './modules/infografis.js';
   // ...
   initInfografis();  // Called on DOMContentLoaded
   ```

2. **Check if data object exists**
   ```javascript
   // In browser console:
   // For infografis page:
   console.log(window.infografisData);  // Should show data object
   
   // For SOTK page:
   console.log(window.staffData);       // Should show data object
   ```

3. **Check if external library loaded**
   ```javascript
   // For chart page:
   console.log(window.Chart);           // Should be Chart.js object
   
   // For AOS page:
   console.log(window.AOS);             // Should be AOS object
   ```

4. **Rebuild and test**
   ```bash
   npm run build
   # Hard refresh browser (Ctrl+Shift+R)
   ```

---

### Problem: 404 on Module File

**Symptoms:**
- Network tab shows 404 error
- Error: "Failed to fetch module from..."
- URL shows `/js/modules/infografis.js`

**Cause:** Vite not bundling modules correctly

**Solutions:**

1. **Check vite.config.js**
   ```bash
   # Verify file exists:
   ls vite.config.js
   ```

2. **Clear build cache**
   ```bash
   rm -r public/build
   npm run build
   ```

3. **Check manifest**
   ```bash
   cat public/build/manifest.json
   # Should have entries for your modules
   ```

---

## 📊 Performance Issues & Solutions

### Problem: Page Loads Slowly

**Symptoms:**
- Blank page for 2+ seconds
- Charts take time to render
- Animations stutter

**Solutions:**

1. **Check network performance**
   ```
   DevTools > Network tab > reload
   Look at file sizes and load times:
   ✅ JS should be ~36KB gzipped
   ✅ CSS should be ~14KB gzipped
   ```

2. **Check if chart data is large**
   ```javascript
   // In browser console:
   console.log(JSON.stringify(window.infografisData).length + ' bytes');
   // If > 100KB, data might be too large
   ```

3. **Optimize by deferring non-critical JS**
   ```html
   <!-- For less critical libraries: -->
   <script src="..." defer></script>
   <!-- This loads after DOM renders -->
   ```

---

### Problem: Animations Stutter/Jank

**Symptoms:**
- Animations not smooth
- Scroll events laggy
- Transitions jerky

**Solutions:**

1. **Check browser DevTools Performance**
   ```
   DevTools > Performance > Record > Scroll page > Stop
   Look for long tasks (red bars)
   ```

2. **Optimize event listeners**
   ```javascript
   // Bad ❌
   window.addEventListener('scroll', function() {
     // Heavy operation every pixel
   });
   
   // Good ✅
   let scrollTimeout;
   window.addEventListener('scroll', function() {
     clearTimeout(scrollTimeout);
     scrollTimeout = setTimeout(() => {
       // Debounced heavy operation
     }, 100);
   });
   ```

3. **Check CSS animations**
   ```css
   /* Avoid animating expensive properties: */
   ❌ width, height, left, right, top, bottom
   ✅ transform, opacity (GPU accelerated)
   ```

---

## 🌐 Browser-Specific Issues

### Chrome Issues

**Problem:** "Module not found" error
```javascript
// Error: Failed to fetch module from /js/modules/xxx.js
// Solution: Check path is correct, rebuild, clear cache
```

**Problem:** Can't access .content() on optional chaining
```javascript
// Error: Cannot read property 'content' of undefined
// In: document.querySelector('meta[name="recaptcha-key"]')?.content
// Solution: Add null check before accessing
```

---

### Firefox Issues

**Problem:** CORS error on module import
```
Error: Cross-Origin Request Blocked
Solution: Ensure vite.config.js has proper server config
```

---

### Safari Issues

**Problem:** Optional chaining not supported
```javascript
// Old Safari doesn't support ?. operator
// Solution: Use traditional null checks
let value = element ? element.content : '';
```

---

## 📋 Checklist: Before Reporting Issue

Before assuming there's a bug, check:

- [ ] Ran `npm run build` recently?
- [ ] Hard refreshed browser (Ctrl+Shift+R)?
- [ ] Checked browser console for errors (F12)?
- [ ] Checked Network tab for 404s?
- [ ] Cleared browser cache?
- [ ] Tried different browser?
- [ ] Checked file exists at path?
- [ ] Verified asset() helper output?
- [ ] Confirmed module imported in app-init.js?
- [ ] Checked data object is set before module call?

---

## 🐛 How to Report Issues

When reporting issues, provide:

1. **What's broken?**
   - Description of problem
   - Expected behavior vs actual

2. **On which page?**
   - URL
   - Page name (beranda, infografis, pengaduan, etc)

3. **Browser info**
   - Browser & version
   - Device (desktop/mobile)

4. **Console errors**
   - Paste error from F12 > Console
   - Include full stack trace

5. **Network tab info**
   - Any 404 errors?
   - Which resources failed to load?

6. **Steps to reproduce**
   - What did you do?
   - What happened?

---

## 🚀 Advanced Debugging

### Enable Debug Logging

Create `resources/js/debug.js`:
```javascript
// Global debug flag
window.DEBUG = true;

// Patch modules to log
const originalInitInfografis = window.initInfografis;
window.initInfografis = function() {
  if (window.DEBUG) console.log('🔵 initInfografis called');
  return originalInitInfografis();
};
```

Import in `app-init.js`:
```javascript
import './debug.js';
```

---

### Use Browser DevTools Properly

**Console Tab:**
- Check for errors (red)
- Check for warnings (yellow)
- Type commands to debug

**Network Tab:**
- Check for 404s
- Check response sizes
- Check timing

**Elements Tab:**
- Inspect HTML structure
- Check applied CSS
- Check computed styles

**Performance Tab:**
- Record page load
- Identify bottlenecks
- Find slow operations

---

## 📞 Quick Support Commands

```bash
# Rebuild everything
npm run build

# Check for errors
npm run build 2>&1 | grep -i error

# List all CSS files
ls -la resources/css/

# List all JS modules
ls -la resources/js/modules/

# Search for specific class/function
grep -r "animate-float" resources/

# Check file sizes after build
du -h public/build/assets/*
```

---

## ✅ Everything Working? Great!

If your site is working properly, you should see:

- ✅ Page loads in <2 seconds
- ✅ No console errors
- ✅ Animations smooth
- ✅ All interactive elements respond
- ✅ Charts render correctly
- ✅ Forms submit without errors
- ✅ Modals open/close smoothly
- ✅ Mobile responsive

---

**Still having issues?** Check AUDIT_AND_FIXES.md for technical details.
