using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class CommentTest
    {
        SeederHandler seederhandler = new SeederHandler();
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;

        [SetUp]
        public void Setup()
        {
            seederhandler.PostsWithCommentsCreationSetUp();
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
        }
        [Test]
        public void CommentCreationOnContentTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("commentinput")));
            var commenttbodyTextArea = driver.FindElement(By.Name("commentinput"));
            commenttbodyTextArea.SendKeys("Testing comment");
            var commentcreationButton = driver.FindElement(By.Name("sendcomment"));
            commentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div[2]/div[2]")));
        }
        [Test]
        public void CommentEditOnContentTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("editcomment")));
            var commenteditButton = driver.FindElement(By.Name("editcomment"));
            commenteditButton.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("savecomment")));
            var commenttbodyTextArea = driver.FindElement(By.Name("editcommentbody"));
            commenttbodyTextArea.SendKeys("test");
            var commenteditsaveButton = driver.FindElement(By.Name("savecomment"));
            commenteditsaveButton.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulupdateAlert = driver.SwitchTo().Alert();
            successfulupdateAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("commentbody")));
            var updatedcomment = driver.FindElement(By.Name("commentbody"));
            Assert.AreEqual(updatedcomment.Text, "Test comment...test");
        }
        [Test]
        public void CommentDeleteOnContentTest()
        {
            driver.Url = baseUrl + "contents/1";
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
        [Test]
        public void CommentCreationOnQuestionTest()
        {
            driver.Url = baseUrl + "questions/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("commentinput")));
            var commenttbodyTextArea = driver.FindElement(By.Name("commentinput"));
            commenttbodyTextArea.SendKeys("Testing comment");
            var commentcreationButton = driver.FindElement(By.Name("sendcomment"));
            commentcreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div[2]/div[2]")));
        }
        [Test]
        public void CommentEditOnQuestionTest()
        {
            driver.Url = baseUrl + "questions/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("editcomment")));
            var commenteditButton = driver.FindElement(By.Name("editcomment"));
            commenteditButton.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("savecomment")));
            var commenttbodyTextArea = driver.FindElement(By.Name("editcommentbody"));
            commenttbodyTextArea.SendKeys("test");
            var commenteditsaveButton = driver.FindElement(By.Name("savecomment"));
            commenteditsaveButton.SendKeys(Keys.Return);
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert successfulupdateAlert = driver.SwitchTo().Alert();
            successfulupdateAlert.Accept();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("commentbody")));
            var updatedcomment = driver.FindElement(By.Name("commentbody"));
            Assert.AreEqual(updatedcomment.Text, "Test comment...test");
        }
        [Test]
        public void CommentDeleteOnQuestionTest()
        {
            driver.Url = baseUrl + "questions/1";
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
            seederhandler.PostsWithCommentsTeardown();
            driver.Quit();
        }
    }
}
