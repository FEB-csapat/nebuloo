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
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
        }
        [Test]
        public void FooterDocumentationTest()
        {
            driver.Url = baseUrl;
            var documentationLink = driver.FindElement(By.Name("footerdocs"));
            documentationLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "documentation"));
        }
        [Test]
        public void FooterTicket_as_guestTest()
        {
            driver.Url = baseUrl;
            var ticketLink = driver.FindElement(By.Name("footerticket"));
            ticketLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert notloggedinAlert = driver.SwitchTo().Alert();
            notloggedinAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "login"));
        }
        [Test]
        public void FooterSourceTest()
        {
            driver.Url = baseUrl;
            var sourceLink = driver.FindElement(By.Name("footersource"));
            sourceLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("https://github.com/FEB-csapat/nebuloo"));
        }
        [Test]
        public void FooterASZFTest()
        {
            driver.Url = baseUrl;
            var aszfLink = driver.FindElement(By.Name("footeraszf"));
            aszfLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "ASZF"));
        }
        [Test]
        public void FooterTicket_as_userTest()
        {
            driver.Url = baseUrl+"login";
            seederhandler.LoginSeederSetUp();
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Password@123");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var ticketLink = driver.FindElement(By.Name("footerticket"));
            ticketLink.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "tickets/create"));
            seederhandler.LoginSeederTearDown();
        }
        [TearDown]
        public void TearDown()
        {
            driver.Quit();
        }
    }
}
