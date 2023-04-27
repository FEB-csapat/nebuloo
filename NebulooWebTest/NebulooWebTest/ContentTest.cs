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
        SeederHandler seederhandler = new SeederHandler();
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;
        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            driver.Url = baseUrl + "login";
            seederhandler.ContentSeederSetUp();
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/form/button"));
            submitButtonLogin.Click();

        }
        [Test]
        public void ContentCreationTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents/create"));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            contentbodyTextArea.SendKeys("Test content");

            var submitButtonContent = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[2]/button"));
            submitButtonContent.Click();
            //TODO: Fix indexing
            //if gives alert->Dont have to fix index => We can check if it gives successalert instead of checking index
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents/2"));
            driver.Quit();

        }
        [Test]
        public void ContentCreationWithoutBodyTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents/create"));

            var submitButtonContent = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[2]/button"));
            submitButtonContent.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert NoBodyAlert = driver.SwitchTo().Alert();
            NoBodyAlert.Accept();
            driver.Quit();
        }
        [Test]
        public void ContentUpdateTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button")));
            var contentupdateButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button"));
            contentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div/div[1]/div[1]/div[1]/select")));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            contentbodyTextArea.SendKeys("Test content");
            var savecontentupdateButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[2]/button"));
            savecontentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert SuccessfulupdateAlert = driver.SwitchTo().Alert();
            SuccessfulupdateAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents/1"));
            driver.Quit();
        }

        [Test]
        public void ContentUpdateWithoutBodyTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button")));
            var contentupdateButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button"));
            contentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div/div[1]/div[1]/div[1]/select")));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            for (int i = 0; i < 255; i++)
            {
                contentbodyTextArea.SendKeys(Keys.Backspace);
            }
            var savecontentupdateButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[2]/button"));
            savecontentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert nobodyupdateAlert = driver.SwitchTo().Alert();
            if (nobodyupdateAlert.Text.ToString() == "A poszt nem lehet üres!")
            {
                Assert.Fail();
                nobodyupdateAlert.Accept();
            }
            else
            {
                Assert.Fail();
            }
            driver.Quit();
        }

        [TearDown]
        public void TearDown()
        {
            seederhandler.ContentSeederTearDown();
        }
    }
}
