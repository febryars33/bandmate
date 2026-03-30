// ecosystem.config.cjs
module.exports = {
    apps: [
        {
            name: 'bandmate-ssr',
            script: 'bootstrap/ssr/ssr.js',
            instances: 'max', // atau jumlah CPU core
            exec_mode: 'cluster', // PM2 yang handle clustering
        },
    ],
}
