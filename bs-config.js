// php -S 0.0.0.0:8181 -t public
// Note: change the api proxy to ur php server in "target: 'http://127.0.0.1:8181', "

/** You can install them globally using npm install -g lite-server http-proxy-middleware connect-history-api-fallback and create environment variable NODE_PATH = C:\Users\mahdy\AppData\Roaming\npm\node_modules then just run lite-server */
var proxyMiddleware = require('http-proxy-middleware');
var fallbackMiddleware = require('connect-history-api-fallback');

module.exports = {
    injectChanges: true,
    port: 8000,
    watchOptions: { ignored: ['node_modules', 'vendor'] },
    files: ['./**/*.{html,htm,css,js}'],
    server: {
        baseDir: '.',
        middleware: {
            1: proxyMiddleware('/api', {
                target: 'http://127.0.0.1:8181',
                changeOrigin: true   // for vhosted sites, changes host header to match to target's host
            }),

            2: fallbackMiddleware({
                index: '/public/index.html', verbose: true
            })
        }
    }
};
