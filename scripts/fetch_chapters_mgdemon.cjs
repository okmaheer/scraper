const puppeteer = require('puppeteer');

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

    // Extract chapter links and chapter numbers from the page
    const chapters = await page.evaluate(() => {
      const links = Array.from(document.querySelectorAll('#chpagedlist li a'));
      return links.map(link => {
        const text = link.querySelector('.chapter-title').textContent.trim();
        const number = text.match(/\d+/); // Extract chapter number
        return {
          url: link.href,
          number: number ? number[0] : null
        };
      }).filter(chapter => chapter.number !== null); // Filter out invalid chapters
    });

    // Send the chapter data back as JSON
    process.stdout.write(JSON.stringify(chapters, null, 2));

  } catch (error) {
    console.error('Error:', error);
  } finally {
    if (browser) {
      await browser.close();
    }
  }
})();
