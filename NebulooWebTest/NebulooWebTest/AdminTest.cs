using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class AdminTest
    {
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;
        [SetUp]
        public void Setup()
        {
            SeederHandler.TestSeederSetUp("SeleniumAdminFunctionTestSeeder");
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            driver.Url = baseUrl + "login";


            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("Admin");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Admin@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));

        }
        [Test]
        public void EditUserProfileTest()
        {
            driver.Url = baseUrl + "users/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("edituserprofile")));

            var edituserprofileButton = driver.FindElement(By.Name("edituserprofile"));
            edituserprofileButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("display_name")));

            var displaynameField = driver.FindElement(By.Name("display_name"));
            displaynameField.SendKeys("EditbyAdmin");

            var bioField = driver.FindElement(By.Name("bio"));
            bioField.SendKeys("The Admin was here");

            var submitchangeButton = driver.FindElement(By.Name("savechange"));
            submitchangeButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfullAlert = driver.SwitchTo().Alert();
            if (successfullAlert.Text.ToString() == "Sikeres felülírás.")
            {
                successfullAlert.Accept();
                wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "users/1"));
                Assert.Pass();
            }
            else
            {
                Assert.Fail();
            }

        }
        [Test]
        public void DeleteUserProfileTest()
        {
            driver.Url = baseUrl + "users/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("deleteuserprofile")));

            var deleteuserprofileButton = driver.FindElement(By.Name("deleteuserprofile"));
            deleteuserprofileButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert confirmationlAlert = driver.SwitchTo().Alert();
            if (confirmationlAlert.Text.ToString() == "Biztosan törölni akarja a felhasználót?")
            {
                confirmationlAlert.Accept();
                wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
                IAlert successalert = driver.SwitchTo().Alert();
                if (successalert.Text.ToString() == "A felhasználó sikeresen kitiltva!")
                {
                    successalert.Accept();
                    wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl+"contents"));
                    Assert.Pass();
                }
                else
                {
                    Assert.Fail();
                }                    
            }
            else
            {
                Assert.Fail();
            }
        }
        [Test]
        public void BanUserProfileTest()
        {
            driver.Url = baseUrl + "users/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("banuserprofile")));

            var banuserprofileButton = driver.FindElement(By.Name("banuserprofile"));
            banuserprofileButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert confirmationlAlert = driver.SwitchTo().Alert();
            if (confirmationlAlert.Text.ToString() == "Biztosan bannolni akarja a felhasználót?")
            {
                confirmationlAlert.Accept();
                wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
                IAlert successalert = driver.SwitchTo().Alert();
                if (successalert.Text.ToString() == "A felhasználó sikeresen kitiltva!")
                {
                    Assert.Pass();
                }
                else
                {
                    Assert.Fail();
                }
            }
            else
            {
                Assert.Fail();
            }
        }

        [Test]
        public void UserContentUpdateTest()
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
        public void UserContentDeletionTest()
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

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "users/1"));
        }
        [Test]
        public void QuestionUpdateTest()
        {
            driver.Url = baseUrl + "questions/1";

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("questionupdate")));
            var questiontupdateButton = driver.FindElement(By.Name("questionupdate"));
            questiontupdateButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("questionupdatetagselector")));
            var questionbodyTextArea = driver.FindElement(By.Name("leiras"));
            questionbodyTextArea.SendKeys("Test question");
            var savequestionupdateButton = driver.FindElement(By.Name("questionupdatesave"));
            savequestionupdateButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulupdateAlert = driver.SwitchTo().Alert();
            successfulupdateAlert.Accept();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions/1"));
        }
        [Test]
        public void QuestionDeletionTest()
        {
            driver.Url = baseUrl + "questions/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("questiondelete")));

            var questiondeleteButton = driver.FindElement(By.Name("questiondelete"));
            questiondeleteButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert deleteconfirmationAlert = driver.SwitchTo().Alert();
            deleteconfirmationAlert.Accept();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfuldeletionAlert = driver.SwitchTo().Alert();
            successfuldeletionAlert.Accept();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "users/1"));
        }
        [Test]
        public void CommentEditOnContentTest()
        {
            driver.Url = baseUrl + "users/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("editcomment")));
            var commenteditButton = driver.FindElement(By.Name("editcomment"));
            commenteditButton.SendKeys(Keys.Return);

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("savecomment")));
            var commenttbodyTextArea = driver.FindElement(By.Name("editcommentbody"));
            commenttbodyTextArea.SendKeys("admin");
            var commenteditsaveButton = driver.FindElement(By.Name("savecomment"));
            commenteditsaveButton.SendKeys(Keys.Return);

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulupdateAlert = driver.SwitchTo().Alert();
            successfulupdateAlert.Accept();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("commentbody")));
            var updatedcomment = driver.FindElement(By.Name("commentbody"));
            Assert.AreEqual(updatedcomment.Text, "Test comment...admin");
        }
        [Test]
        public void CommentDeleteOnContentTest()
        {
            driver.Url = baseUrl + "users/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("deletecomment")));
            var commentdeleteButton = driver.FindElement(By.Name("deletecomment"));
            commentdeleteButton.SendKeys(Keys.Return);

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert deletionAlert = driver.SwitchTo().Alert();
            deletionAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfuldeletionAlert = driver.SwitchTo().Alert();
            successfuldeletionAlert.Accept();
        }

        [TearDown]
        public void TearDown()
        {
            SeederHandler.TestSeederTearDown("SeleniumAdminFunctionTestTearDownSeeder");
            driver.Quit();
        }
    }
}
