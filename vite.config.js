/** @type {import('vite').UserConfig} */
export default {
    build: {
        assetsDir: "resources",
        outDir: "resources/dist",
        rollupOptions: {
            input: ["resources/js/tall-datatables.js", "resources/css/tall-datatables.css"],
            output: {
                assetFileNames: "[name][extname]",
                entryFileNames: "[name].js",
            },
        },
    },
};
