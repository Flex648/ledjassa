const cacheName = 'djassa-cache-v1';
const filesToCache = [
  '/',
  '/index.php',
  '/produits.php',
  '/style.css',
  '/bootstrap.css',
  '/img/logo2.png'
];

self.addEventListener('install', function(e) {
  e.waitUntil(
    caches.open(cacheName).then(function(cache) {
      return cache.addAll(filesToCache);
    })
  );
});

self.addEventListener('fetch', function(e) {
  e.respondWith(
    caches.match(e.request).then(function(response) {
      return response || fetch(e.request);
    })
  );
});
