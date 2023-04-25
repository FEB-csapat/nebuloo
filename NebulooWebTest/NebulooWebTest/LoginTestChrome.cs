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

        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
        }

        [Test]
        public void SuccessfulLoginTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("Admin");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("admin123");

            var submitButton = driver.FindElement(By.XPath("//*[@id=\"button\"]"));
            submitButton.Click();

            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));

            driver.Quit();
        }

        [Test]
        public void LoginWithBadIdentifierTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("Admin@");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("admin123");

            var submitButton = driver.FindElement(By.XPath("//*[@id=\"button\"]"));
            submitButton.Click();

            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());

            driver.Quit();
        }

        [Test]
        public void LoginWithBadPasswordTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("Admin");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("a");

            var submitButton = driver.FindElement(By.XPath("//*[@id=\"button\"]"));
            submitButton.Click();

            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());

            driver.Quit();
        }

        [Test]
        public void LoginWithBadIdentifierAndPasswordTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("Admin@");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("a");

            var submitButton = driver.FindElement(By.XPath("//*[@id=\"button\"]"));
            submitButton.Click();

            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());

            driver.Quit();
        }
    }
}
