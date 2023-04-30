using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class TicketTest
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
            seederhandler.TicketSeederSetUp();
        }
        [Test]
        public void TicketCreationTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "tickets/create";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("ticketinput")));
            var ticketbodyTextArea = driver.FindElement(By.Name("ticketinput"));
            ticketbodyTextArea.SendKeys("Testing bug");
            var ticketcreationButton = driver.FindElement(By.Name("createticket"));
            ticketcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulticketcreationAlert = driver.SwitchTo().Alert();
            successfulticketcreationAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "me"));
        }
        [Test]
        public void TicketViewAs_UserTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "tickets/";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("ticketunauthentry")));
        }
        [Test]
        public void TicketViewAs_AdminTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("Admin");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Admin@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "tickets/";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.ClassName("ticketcard")));
        }
        [Test]
        public void TicketAcceptAs_AdminTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("Admin");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Admin@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "tickets/";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.ClassName("ticketcard")));
            var acceptticketButton = driver.FindElement(By.Name("acceptticket"));
            acceptticketButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulticketacceptionAlert = driver.SwitchTo().Alert();
            successfulticketacceptionAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[1]/div[2]/div/button[1]")));
            var stateLabel = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/div[2]/h6"));
            Assert.AreEqual(stateLabel.Text, "Állapot: Javítva");
        }
        [Test]
        public void TicketReopenAs_AdminTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("Admin");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Admin@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "tickets/";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.ClassName("ticketcard")));

            var reopenticketButton = driver.FindElement(By.Name("reopenticket"));
            reopenticketButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulticketacceptionAlert = driver.SwitchTo().Alert();
            successfulticketacceptionAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div[2]/div/button[1]")));
            var stateLabel = driver.FindElement(By.XPath("/html/body/div/div[1]/div[2]/div[2]/h6"));
            Assert.AreEqual(stateLabel.Text, "Állapot: Várakozik");
        }
        [Test]
        public void TicketDeletionAs_AdminTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("Admin");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Admin@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "tickets/";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.ClassName("ticketcard")));

            var denyticketButton = driver.FindElement(By.Name("denyticket"));
            denyticketButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulticketdeletionAlert = driver.SwitchTo().Alert();
            successfulticketdeletionAlert.Accept();
        }
        [TearDown]
        public void TearDown()
        {
            seederhandler.TicketSeederTeardown();
            driver.Quit();
        }
    }
}
