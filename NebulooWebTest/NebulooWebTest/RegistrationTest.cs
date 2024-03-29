using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class RegistrationTest
    {
        IWebDriver driver;

        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;
        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();

            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
        }

        [Test]
        public void SuccessfulRegistrationTest()
        {
            SeederHandler.TestSeederSetUp("SeleniumRegistrationTestSeeder");
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("username"));
            usernameTextbox.SendKeys("NewUser12222");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("email@testing.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123@");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123@");

            var ASZF = driver.FindElement(By.Name("aszf"));
            ASZF.Click();

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
        }

        [Test]
        public void RegistrationWithIncorrectUsernameTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("username"));
            usernameTextbox.SendKeys("Test@");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("email@testing.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123@");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123@");

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            var Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span"));
            if (Error_message.Text.Contains("A(z) felhasználó név kizárólag betűket és számokat tartalmazhat"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
        }

        [Test]
        public void RegistrationWithIncorrectEmailTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("username"));
            usernameTextbox.SendKeys("Test1");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("emailtesting.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123@");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123@");

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            var Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span"));
            if (Error_message.Text.Contains("A(z) e-mail cím nem érvényes email formátum"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
        }

        [Test]
        public void RegistrationWithIncorrectPasswordTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("username"));
            usernameTextbox.SendKeys("TestUser");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("email@testing.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123");

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            var Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span"));
            if (Error_message.Text.Contains("A(z) jelszó formátuma érvénytelen"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
        }

        [Test]
        public void RegistrationWithNotMatchingPasswordTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("username"));
            usernameTextbox.SendKeys("TestUser");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("email@testing.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123@");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123");

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            var Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span"));
            if (Error_message.Text.Contains("A(z) jelszó ellenőrző nem egyezik a megerősítéssel"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
        }

        [Test]
        public void RegistrationWithIncorrectFields()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("username"));
            usernameTextbox.SendKeys("TestUser@");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("emailtesting.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("jelszo123");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("jelszo12");

            var Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[1]"));
            if (Error_message.Text.Contains("A(z) felhasználó név kizárólag betűket és számokat tartalmazhat"))
            {
                Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[2]"));
                if (Error_message.Text.Contains("A(z) e-mail cím nem érvényes email formátum"))
                {
                    Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[2]"));
                    if (Error_message.Text.Contains("A(z) jelszó formátuma érvénytelen"))
                    {
                        Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[4]"));
                        if (Error_message.Text.Contains("A(z) jelszó ellenőrző nem egyezik a megerősítéssel"))
                        {
                            Assert.Pass();
                        }
                    }
                }
            }
            else
            {
                Assert.Fail();
            }
        }
        [TearDown]
        public void TearDown()
        {
            SeederHandler.TestSeederTearDown("SeleniumRegistrationTestSeeder");
            driver.Quit();
        }
    }
}
