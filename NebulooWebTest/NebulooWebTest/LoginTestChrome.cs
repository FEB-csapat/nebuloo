using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;

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
            string currentPage = driver.Url;
            var usernameTextbox = driver.FindElement(By.Name("identifier"));
            usernameTextbox.SendKeys("Admin");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("admin123");

            var submitButton = driver.FindElement(By.XPath("//*[@id=\"button\"]"));
            submitButton.Click();

            while (true)
            {
                try
                {
                    string newPage = driver.Url;
                    if (currentPage == newPage)
                    {
                        Assert.Fail();
                        break;
                    }
                    else
                    {
                        Assert.Pass();
                        break;
                    }
                }
                catch
                {

                }
            }
            driver.Quit();
        }
    }
}