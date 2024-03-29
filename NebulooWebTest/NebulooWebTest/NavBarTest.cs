using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class NavBarTest
    {
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;

        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));

            driver.Url = baseUrl;
            var enterasguestButton = driver.FindElement(By.Name("enterasguest"));
            enterasguestButton.SendKeys(Keys.Return);
        }
        [Test]
        public void NavBarMainMenuTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var mainmenuButton = driver.FindElement(By.Id("nebuloo-title"));
            mainmenuButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl));
        }
        [Test]
        public void NavBarQuestionsViewTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var questionsviewButton = driver.FindElement(By.Name("navquestions"));
            questionsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions"));
        }
        [Test]
        public void NavBarContentsViewTest()
        {
            driver.Url = baseUrl + "questions";
            var contentsviewButton = driver.FindElement(By.Name("navcontents"));
            contentsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
        }
        [Test]
        public void NavBarTicketsViewTest()
        {
            driver.Url = baseUrl + "login";
            SeederHandler.TestSeederSetUp("SeleniumLoginTestSeeder");
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("Admin");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Admin@123");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));

            var ticketsviewButton = driver.FindElement(By.Name("navtickets"));
            ticketsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "tickets"));
            SeederHandler.TestSeederTearDown("SeleniumLoginTestTearDownSeeder");
        }
        [Test]
        public void NavbarMyprofile_as_userTest()
        {
            driver.Url = baseUrl + "login";
            SeederHandler.TestSeederSetUp("SeleniumLoginTestSeeder");
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Password@123");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var myprofileButton = driver.FindElement(By.Name("navprofile"));
            myprofileButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "me"));
            SeederHandler.TestSeederTearDown("SeleniumLoginTestTearDownSeeder");
        }
        [Test]
        public void NavbarMyprofile_as_guestTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var loginButton = driver.FindElement(By.Name("navlogin"));
            loginButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "login"));
        }
        
        [TearDown]
        public void TearDown()
        {
            driver.Quit();
        }
    }
}
