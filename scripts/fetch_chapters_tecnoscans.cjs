const puppeteer = require('puppeteer');
const fs = require('fs');

(async () => {
  const url = process.argv[2];

  if (!url) {
    console.error('URL is required');
    process.exit(1);
  }

  let browser;
  try {
    // Launch the browser with required arguments
    browser = await puppeteer.launch({
      args: ['--no-sandbox', '--disable-setuid-sandbox']
    });
    const page = await browser.newPage();

    // Navigate to the provided URL and wait for the network to be idle
    await page.goto(url, { waitUntil: 'networkidle2' });

    // Extract chapter links and chapter numbers from the page
    const chapters = await page.evaluate(() => {
      const links = Array.from(document.querySelectorAll('#chapterlist li .eph-num a'));
      return links.map(link => {
        const text = link.querySelector('.chapternum').textContent.trim();
        const match = text.match(/chapter\s*[\d.]+/i);
        return {
          url: link.href,
          number: match ? match[0].replace(/chapter\s*/i, '') : null
        };
      }).filter(chapter => chapter.number !== null); // Filter out invalid chapters
    });

    // Save chapter links and numbers to a file
    fs.writeFileSync('tecnoscans_chapters.json', JSON.stringify(chapters, null, 2));

    console.log('Chapters data saved successfully.');
  } catch (error) {
    console.error('Error:', error);
  } finally {
    if (browser) {
      await browser.close();
    }
  }
})();
