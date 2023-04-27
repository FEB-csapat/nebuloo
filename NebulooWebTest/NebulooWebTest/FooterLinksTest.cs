using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class FooterLinksTest
    {
        SeederHandler seederhandler = new SeederHandler();
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;

        [SetUp]
        public void Setup()
        {
            seederhandler.LoginSeederSetUp();
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
        }
        [Test]
        public void FooterDocumentationTest()
        {
            driver.Url = baseUrl;
            var documentationLink = driver.FindElement(By.XPath("/html/body/div/div[4]/footer/div[2]/div[1]/a"));
            documentationLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/documentation"));
            driver.Quit();
        }
        [Test]
        public void FooterTicket_as_guestTest()
        {
            driver.Url = baseUrl;
            var ticketLink = driver.FindElement(By.XPath("/html/body/div/div[4]/footer/div[2]/div[2]/a"));
            ticketLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert notloggedinAlert = driver.SwitchTo().Alert();
            notloggedinAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/login"));
            driver.Quit();
        }
        [Test]
        public void FooterSourceTest()
        {
            driver.Url = baseUrl;
            var sourceLink = driver.FindElement(By.XPath("/html/body/div/div[4]/footer/div[2]/div[3]/a"));
            sourceLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("https://github.com/FEB-csapat/nebuloo"));
            driver.Quit();
        }
        [Test]
        public void FooterASZFTest()
        {
            driver.Url = baseUrl;
            var aszfLink = driver.FindElement(By.XPath("/html/body/div/div[4]/footer/div[2]/div[4]/a"));
            aszfLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/ASZF"));
            driver.Quit();
        }
        [TearDown]
        public void TearDown()
        {
            seederhandler.LoginSeederTearDown();
        }
    }
}
