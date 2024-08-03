const puppeteer = require('puppeteer');

async function fetchImages(urls) {
    const browser = await puppeteer.launch({
        args: ['--no-sandbox', '--disable-setuid-sandbox']
    });

    let allImages = [];

    for (const url of urls) {
        const page = await browser.newPage();

        try {
            await page.goto(url, { waitUntil: 'networkidle2', timeout: 70000 }); // Increased timeout to 60 seconds
        } catch (error) {
            console.error(`Navigation to ${url} timed out or failed: ${error}`);
            await page.close();
            continue;
        }

        try {
            const images = await page.evaluate(() => {
                return Array.from(document.querySelectorAll('#readerarea .ts-main-image')).map(img => img.src);
            });

            allImages = allImages.concat(images);
        } catch (error) {
            console.error(`Failed to fetch images from ${url}: ${error}`);
        }

        await page.close();
    }

    await browser.close();
    return allImages;
}

// Command line arguments
const args = process.argv.slice(2);
const urls = JSON.parse(Buffer.from(args[0], 'base64').toString('utf-8'));

fetchImages(urls).then(images => {
    console.log(JSON.stringify(images));
}).catch(err => {
    console.error(err);
});
