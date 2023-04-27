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
            var enterasguestButton = driver.FindElement(By.XPath("/html/body/div/div[3]/div/div/div[2]/a/button"));
            enterasguestButton.Click();
        }
        [Test]
        public void NavBarMainMenuTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var mainmenuButton = driver.FindElement(By.XPath("/html/body/div/nav/div/a/h1"));
            mainmenuButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/"));
            driver.Quit();
        }
        [Test]
        public void NavBarQuestionsViewTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var questionsviewButton = driver.FindElement(By.XPath("/html/body/div/nav/div/div/div/button/a"));
            questionsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/questions"));
            driver.Quit();
        }
        [Test]
        public void NavBarContentsViewTest()
        {
            driver.Url = baseUrl + "questions";
            var contentsviewButton = driver.FindElement(By.XPath("/html/body/div/nav/div/div/div/button/a"));
            contentsviewButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            driver.Quit();
        }
        [Test]
        public void NavbarMyprofile_as_userTest()
        {
            driver.Url = baseUrl + "login";
            seederhandler.LoginSeederSetUp();
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Password@123");

            var submitButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/form/button"));
            submitButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var myprofileButton = driver.FindElement(By.XPath("/html/body/div/nav/div/div/div[2]/div/a/div/img"));
            myprofileButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/myprofile"));
            driver.Quit();
            seederhandler.LoginSeederTearDown();
        }
        [Test]
        public void NavbarMyprofile_as_guestTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var loginButton = driver.FindElement(By.XPath("/html/body/div/nav/div/div/button/a"));
            loginButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/login"));
            driver.Quit();
            seederhandler.LoginSeederTearDown();
        }
        //TODO:myprofile->logged in
        //TODO:searchbar
    }
}
