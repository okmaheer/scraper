const puppeteer = require('puppeteer');

async function fetchImages(url) {
    const browser = await puppeteer.launch({
        args: ['--no-sandbox', '--disable-setuid-sandbox']
      });
      
      const page = await browser.newPage();
    
    try {
        await page.goto(url, { waitUntil: 'networkidle2', timeout: 70000 }); // Increased timeout to 60 seconds
    } catch (error) {
        console.error(`Navigation to ${url} timed out or failed: ${error}`);
        await browser.close();
        return [];
    }

    try {
        const images = await page.evaluate(() => {
            return Array.from(document.querySelectorAll('#readerarea .ts-main-image')).map(img => img.src);
        });

        await browser.close();
        return images;
    } catch (error) {
        console.error(`Failed to fetch images from ${url}: ${error}`);
        await browser.close();
        return [];
    }
}

// Command line arguments
const url = process.argv[2];

fetchImages(url).then(images => {
    console.log(JSON.stringify(images));
}).catch(err => {
    console.error(err);
});
