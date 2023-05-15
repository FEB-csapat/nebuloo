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
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;
        [SetUp]
        public void Setup()
        {
            SeederHandler.TestSeederSetUp("SeleniumMyProfileTestSeeder");
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

        }
        [Test]
        public void EditProfileTest()
        {
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("editprofile")));

            var editmyprofileButton = driver.FindElement(By.Name("editprofile"));
            editmyprofileButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("display_name")));

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
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("deleteprofile")));

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
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("logout")));

            var logoutmyprofileButton = driver.FindElement(By.Name("logout"));
            logoutmyprofileButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl));
        }

        [TearDown]
        public void TearDown()
        {
            SeederHandler.TestSeederTearDown("SeleniumMyProfileTestTearDownSeeder");
            driver.Quit();
        }
    }
}
