using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class LoginTestChrome
    {
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;

        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            SeederHandler.TestSeederSetUp("SeleniumLoginTestSeeder");
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
        }

        [Test]
        public void SuccessfulLoginTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Password@123");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
        }

        [Test]
        public void LoginWithBadIdentifierTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser@");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Password@123");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("errormessage")));
        }

        [Test]
        public void LoginWithBadPasswordTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("a");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("errormessage")));
        }

        [Test]
        public void LoginWithBadIdentifierAndPasswordTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("TestUser@");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("a");

            var submitButton = driver.FindElement(By.Name("login"));
            submitButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("errormessage")));
        }
        [TearDown]
        public void TearDown()
        {
            SeederHandler.TestSeederTearDown("SeleniumLoginTestTearDownSeeder");
            driver.Quit();
        }
    }
}
