using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class MyProfileTest
    {
        IWebDriver driver;
        SeederHandler seederhandler = new SeederHandler();
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;
        [SetUp]
        public void Setup()
        {
            seederhandler.MyProfileSeederSetUp();
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            driver.Url = baseUrl + "login";

            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "me";
        }
        [Test]
        public void EditProfileTest()
        {
            var editmyprofileButton = driver.FindElement(By.Name("editprofile"));
            editmyprofileButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "users/1/edit"));
            var displaynameField = driver.FindElement(By.Name("display_name"));
            displaynameField.SendKeys("NewTestUser");

            var bioField = driver.FindElement(By.Name("bio"));
            bioField.SendKeys("I'm the test user");

            var submitchangeButton = driver.FindElement(By.Name("savechange"));
            submitchangeButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfullAlert = driver.SwitchTo().Alert();
            if (successfullAlert.Text.ToString() == "Sikeres változtatás")
            {
                successfullAlert.Accept();
                wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "me"));
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }              

        }
        [Test]
        public void DeleteMyProfileTest()
        {
            var deletemyprofileButton = driver.FindElement(By.Name("deleteprofile"));
            deletemyprofileButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert confirmationlAlert = driver.SwitchTo().Alert();
            if (confirmationlAlert.Text.ToString() == "Biztosan törölni szeretné fiókját?")
            {
                confirmationlAlert.Accept();
                wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl));
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
        }
        [Test]
        public void LogOutFromProfileTest()
        {
            var logoutmyprofileButton = driver.FindElement(By.Name("logout"));
            logoutmyprofileButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl));
        }
        [TearDown]
        public void TearDown()
        {
            seederhandler.MyProfileSeederTearDown();
            driver.Quit();
        }
    }
}
