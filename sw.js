const CACHE_NAME = 'redivivus-cache-v1';
const urlsToCache = [
  '/',
  '/index.html',
  '/indexColetaSeletiva.html',
  '/indexMaps.html',
  '/indexContato.html',
  '/css/styles.css',
  '/Imgs/NomeLogo.png',
  '/Imgs/Logo.png',
  '/Imgs/REDIVIVUS.png'
];

self.addEventListener('install', function(event) {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(function(cache) {
        console.log('Cache aberto');
        return cache.addAll(urlsToCache);
      })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
    caches.match(event.request)
      .then(function(response) {
        if (response) {
          return response;
        }
        return fetch(event.request);
      })
  );
});
  