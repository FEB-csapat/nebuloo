using OpenQA.Selenium.Firefox;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;

namespace NebulooWebTest
{
    public class RegistrationTestFirefox
    {
        IWebDriver driver;

        static string baseUrl = "http://localhost:8881";
        

        [SetUp]
        public void Setup()
        {
            new DriverManager().SetUpDriver(new FirefoxConfig());
            driver = new FirefoxDriver();
        }

        [Test]
        public void SuccessfulRegistrationTest()
        {
            driver.Navigate().GoToUrl(baseUrl+"registration");

            var usernameTextbox = driver.FindElement(By.Name("name"));
            usernameTextbox.SendKeys("NewUser12222");

            var emailTextbox = driver.FindElement(By.Name("email"));
            emailTextbox.SendKeys("email@testing.com");

            var passwordTextbox = driver.FindElement(By.Name("password"));
            passwordTextbox.SendKeys("Jelszo123@");

            var passwordAgainTextbox = driver.FindElement(By.Name("password_confirmation"));
            passwordAgainTextbox.SendKeys("Jelszo123@");

            var submitButton = driver.FindElement(By.Id("registrationbutton"));
            submitButton.Click();

            while (true)
            {
                try
                {
                    IAlert simpleAlert = driver.SwitchTo().Alert();
                    if (simpleAlert.Text.Contains("Sikeres regisztráció"))
                    {
                        simpleAlert.Accept();
                        break;
                    }
                    else
                    {
                        simpleAlert.Dismiss();
                        Assert.Fail();
                        break;
                    }
                }
                catch
                {

                }
            }
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
