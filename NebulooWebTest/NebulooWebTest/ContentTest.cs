using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class ContentTest
    {
        IWebDriver driver;

        static string baseUrl = "http://localhost:8881/";

        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
            usernameTextbox.SendKeys("ContentTester");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("email@contenttesting.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123@");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123@");

            var ASZF = driver.FindElement(By.Name("aszf"));
            ASZF.Click();

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());

            IAlert simpleAlert = driver.SwitchTo().Alert();
            simpleAlert.Accept();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/login"));


            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("ContentTester");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Jelszo123@");

            var submitButtonLogin = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/form/button"));
            submitButtonLogin.Click();

        }
        [Test]
        public void ContentCreationTest()
        {
            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents/create"));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            contentbodyTextArea.SendKeys("Test content");

            var submitButtonContent = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[2]/button"));
            submitButtonContent.Click();
            //destruction
            driver.Url = baseUrl + "myprofile";
            var deleteuserButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button"));
            deleteuserButton.Click();
            IAlert UserDeleteAlert = driver.SwitchTo().Alert();
            UserDeleteAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            driver.Quit();

        }
        [Test]
        public void ContentCreationWithoutBodyTest()
        {
            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents/create"));

            var submitButtonContent = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[2]/button"));
            submitButtonContent.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert NoBodyAlert = driver.SwitchTo().Alert();
            NoBodyAlert.Accept();
            //destruction
            driver.Url = baseUrl + "myprofile";
            var deleteuserButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button"));
            deleteuserButton.Click();
            IAlert UserDeleteAlert = driver.SwitchTo().Alert();
            UserDeleteAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            driver.Quit();
        }
    }
}
