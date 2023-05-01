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

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
        }
        [Test]
        public void ContentCreationTest()
        {
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/create"));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            contentbodyTextArea.SendKeys("Test content");

            var submitButtonContent = driver.FindElement(By.Name("createcontent"));
            submitButtonContent.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/"));

        }
        [Test]
        public void ContentCreationWithTagsTest()
        {
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/create"));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            contentbodyTextArea.SendKeys("Test content");


            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contentdfgs/"));
            var submitButtonContent = driver.FindElement(By.Name("createcontent"));
            submitButtonContent.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/"));

        }
        [Test]
        public void ContentCreationWithoutBodyTest()
        {
            var contentcreationButton = driver.FindElement(By.ClassName("fab-button"));
            contentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/create"));

            var submitButtonContent = driver.FindElement(By.Name("createcontent"));
            submitButtonContent.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert nobodyAlert = driver.SwitchTo().Alert();
            nobodyAlert.Accept();
        }
        [Test]
        public void ContentUpdateTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("contentupdate")));
            var contentupdateButton = driver.FindElement(By.Name("contentupdate"));
            contentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("contentupdatetagselector")));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            contentbodyTextArea.SendKeys("Test content");
            var savecontentupdateButton = driver.FindElement(By.Name("contentupdatesave"));
            savecontentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulupdateAlert = driver.SwitchTo().Alert();
            successfulupdateAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/1"));
        }

        [Test]
        public void ContentUpdateWithoutBodyTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("detailedcontenttags")));
            var contentupdateButton = driver.FindElement(By.Name("contentupdate"));
            contentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("contentupdatetagselector")));
            var contentbodyTextArea = driver.FindElement(By.XPath("/html/body/div/div[1]/div/div[1]/div[2]/div[2]/div[1]/textarea"));
            for (int i = 0; i < 255; i++)
            {
                contentbodyTextArea.SendKeys(Keys.Backspace);
            }
            var savecontentupdateButton = driver.FindElement(By.Name("contentupdatesave"));
            savecontentupdateButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert nobodyupdateAlert = driver.SwitchTo().Alert();
            if (nobodyupdateAlert.Text.ToString() == "A poszt nem lehet üres!")
            {
                Assert.Pass();
                nobodyupdateAlert.Accept();
            }
            else
            {
                Assert.Fail();
            }
        }
        [Test]
        public void ContentDeletionTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("contentdelete")));

            var contentdeleteButton = driver.FindElement(By.Name("contentdelete"));
            contentdeleteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert deleteconfirmationAlert = driver.SwitchTo().Alert();
            deleteconfirmationAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfuldeletionAlert = driver.SwitchTo().Alert();
            successfuldeletionAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "me"));
        }
        [Test]
        public void ContentShowTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("contentcard")));
            var contentCard = driver.FindElement(By.Name("contentcard"));
            contentCard.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents/1"));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("contentdownload")));
        }

        [TearDown]
        public void TearDown()
        {
            seederhandler.ContentSeederTearDown();
            driver.Quit();
        }
    }
}
