using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class NavBarTest
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

            driver.Url = baseUrl;
            var enterasguestButton = driver.FindElement(By.Name("enterasguest"));
            enterasguestButton.Click();
        }
        [Test]
        public void NavBarMainMenuTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var mainmenuButton = driver.FindElement(By.Id("nebuloo-title"));
            mainmenuButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl));
            driver.Quit();
        }
        [Test]
        public void NavBarQuestionsViewTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var questionsviewButton = driver.FindElement(By.Name("navquestions"));
            questionsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions"));
            driver.Quit();
        }
        [Test]
        public void NavBarContentsViewTest()
        {
            driver.Url = baseUrl + "questions";
            var contentsviewButton = driver.FindElement(By.Name("navcontents"));
            contentsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Quit();
        }
        [Test]
        public void NavbarMyprofile_as_userTest()
        {
            //doesnt work because after login on navbar there is a login button instead of myprofile
            //TODO: fix refresh of navbar after login
            driver.Url = baseUrl + "login";
            seederhandler.LoginSeederSetUp();
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Password@123");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var myprofileButton = driver.FindElement(By.Name("navprofile"));
            myprofileButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "myprofile"));
            driver.Quit();
            seederhandler.LoginSeederTearDown();
        }
        [Test]
        public void NavbarMyprofile_as_guestTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            var loginButton = driver.FindElement(By.Name("navlogin"));
            loginButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "login"));
            driver.Quit();
            seederhandler.LoginSeederTearDown();
        }
        //TODO:searchbar
    }
}
