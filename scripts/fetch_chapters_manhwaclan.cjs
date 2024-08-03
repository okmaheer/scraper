const puppeteer = require('puppeteer');
const fs = require('fs');

(async () => {
  const url = process.argv[2];

  if (!url) {
    console.error('URL is required');
    process.exit(1);
  }

  const browser = await puppeteer.launch({
    args: ['--no-sandbox', '--disable-setuid-sandbox']
  });
  const page = await browser.newPage();
    // Increase navigation timeout to 60 seconds
    const navigationTimeout = 60000;

    // Retry mechanism for navigation
    const maxRetries = 3;
    let retries = 0;
    let success = false;

    while (retries < maxRetries && !success) {
      try {
        // Navigate to the provided URL and wait for the network to be idle
        await page.goto(url, { waitUntil: 'networkidle2', timeout: navigationTimeout });
        success = true;
      } catch (error) {
        retries++;
        console.error(`Navigation attempt ${retries} failed. Retrying...`);
        if (retries >= maxRetries) {
          throw new Error(`Failed to navigate to ${url} after ${maxRetries} attempts`);
        }
      }
    }
  // Extract chapter links and chapter numbers from manhwaclan.com
  const chapters = await page.evaluate(() => {
    const links = Array.from(document.querySelectorAll('.listing-chapters_wrap .wp-manga-chapter a'));
    return links.map(link => {
      const text = link.textContent.trim();
      const match = text.match(/chapter\s*[\d.]+/i);
      return {
        url: link.href,
        number: match ? match[0].replace(/chapter\s*/i, '') : null
      };
    }).filter(chapter => chapter.number !== null); // Filter out invalid chapters
  });

  // Save chapter links and numbers to a file
  fs.writeFileSync('manhwaclan_chapters.json', JSON.stringify(chapters, null, 2));

  await browser.close();
})();
