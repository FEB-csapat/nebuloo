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
    
        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
        }

        [Test]
        public void SuccessfulRegistrationTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
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

            var wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());


            IAlert simpleAlert = driver.SwitchTo().Alert();
            simpleAlert.Accept();

            //destruction
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/login"));


            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("NewUser12222");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Jelszo123@");

            var submitButtonLogin = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/form/button"));
            submitButtonLogin.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains("http://localhost:8881/contents"));

            driver.Url = baseUrl + "myprofile";
            var deleteuserButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[1]/div[4]/div[2]/button"));
            deleteuserButton.Click();
            IAlert UserDeleteAlert = driver.SwitchTo().Alert();
            UserDeleteAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            driver.Quit();
        }

        [Test]
        public void RegistrationWithIncorrectUsernameTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
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
            if (Error_message.Text.Contains("name is not valid"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
            driver.Quit();
        }

        [Test]
        public void RegistrationWithIncorrectEmailTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
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
            if (Error_message.Text.Contains("email is not valid"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
            driver.Quit();
        }

        [Test]
        public void RegistrationWithIncorrectPasswordTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
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
            if (Error_message.Text.Contains("password is not valid"))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
            driver.Quit();
        }

        [Test]
        public void RegistrationWithNotMatchingPasswordTest()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
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
            if (Error_message.Text.Contains("password_confirmation is not valid."))
            {
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }
            driver.Quit();
        }

        [Test]
        public void RegistrationWithIncorrectFields()
        {
            driver.Url = baseUrl + "registration";

            var usernameTextbox = driver.FindElement(By.Name("name"));
            usernameTextbox.SendKeys("TestUser@");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("emailtesting.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("jelszo123");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("jelszo12");

            var Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[1]"));
            if (Error_message.Text.Contains("name is not valid"))
            {
                Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[2]"));
                if (Error_message.Text.Contains("email is not valid"))
                {
                    Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[2]"));
                    if (Error_message.Text.Contains("password is not valid"))
                    {
                        Error_message = driver.FindElement(By.XPath("/html/body/div/div[1]/div/form/span[4]"));
                        if (Error_message.Text.Contains("password_confirmation is not valid"))
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
            driver.Quit();
        }
    }
}
