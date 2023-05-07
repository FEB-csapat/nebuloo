using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class VoteTest
    {
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;

        [SetUp]
        public void Setup()
        {
            SeederHandler.TestSeederSetUp("SeleniumPostActionsTestSeeder");
            new DriverManager().SetUpDriver(new ChromeConfig());
            driver = new ChromeDriver();
            wait = new WebDriverWait(driver, new TimeSpan(0, 0, 15));
            
        }
        [Test]
        public void UpVoteCreationOnContentTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("upvote_arrow")));
            var upvoteButton = driver.FindElement(By.Name("upvote_arrow"));
            upvoteButton.Click();
            Thread.Sleep(600);
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("votescore")));
            var votescoreLabel = driver.FindElement(By.Name("votescore"));
            Assert.AreEqual(int.Parse(votescoreLabel.Text), 1);
        }
        [Test]
        public void DownVoteCreationOnContentTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("downvote_arrow")));
            var upvoteButton = driver.FindElement(By.Name("downvote_arrow"));
            upvoteButton.Click();
            Thread.Sleep(600);
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("votescore")));
            var votescoreLabel = driver.FindElement(By.Name("votescore"));
            Assert.AreEqual(int.Parse(votescoreLabel.Text), -1);
        }
        [Test]
        public void UpVoteCreationOnQuestionTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "questions";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("upvote_arrow")));
            var upvoteButton = driver.FindElement(By.Name("upvote_arrow"));
            upvoteButton.Click();
            Thread.Sleep(600);
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("votescore")));
            var votescoreLabel = driver.FindElement(By.Name("votescore"));
            Assert.AreEqual(int.Parse(votescoreLabel.Text), 1);
        }
        [Test]
        public void DownVoteCreationOnQuestionTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "questions";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("downvote_arrow")));
            var upvoteButton = driver.FindElement(By.Name("downvote_arrow"));
            upvoteButton.Click();
            Thread.Sleep(600);
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("votescore")));
            var votescoreLabel = driver.FindElement(By.Name("votescore"));
            Assert.AreEqual(int.Parse(votescoreLabel.Text), -1);
        }
        [Test]
        public void UpVoteCreationOnCommentTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));

            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[1]")));
            var upvoteButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[1]"));
            upvoteButton.Click();
            Thread.Sleep(600);
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("votescore")));
            var votescoreLabel = driver.FindElement(By.Name("votescore"));
            Assert.AreEqual(int.Parse(votescoreLabel.Text), 1);
        }
        [Test]
        public void DownVoteCreationOnCommentTest()
        {
            driver.Url = baseUrl + "login";
            var usernameTextboxLogin = driver.FindElement(By.Name("identifier"));
            usernameTextboxLogin.SendKeys("TestUser");

            var passwordTextboxLogin = driver.FindElement(By.Name("password"));
            passwordTextboxLogin.SendKeys("Password@123");

            var submitButtonLogin = driver.FindElement(By.Name("login"));
            submitButtonLogin.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "contents"));
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[2]")));
            var downvoteButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[2]"));
            downvoteButton.Click();
            Thread.Sleep(600);
            driver.Url = baseUrl + "me";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("votescore")));
            var votescoreLabel = driver.FindElement(By.Name("votescore"));
            Assert.AreEqual(int.Parse(votescoreLabel.Text), -1);
        }
        [Test]
        public void UpVoteCreationOnContentAs_GuestTest()
        {
            driver.Url = baseUrl + "contents";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("unauthupvote_arrow")));
            var upvoteButton = driver.FindElement(By.Name("unauthupvote_arrow"));
            upvoteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert failedupvoteAlert = driver.SwitchTo().Alert();
            failedupvoteAlert.Accept();
        }
        [Test]
        public void DownVoteCreationOnContentAs_GuestTest()
        {
            driver.Url = baseUrl + "contents";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("unauthdownvote_arrow")));
            var downvoteButton = driver.FindElement(By.Name("unauthdownvote_arrow"));
            downvoteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert failedupvoteAlert = driver.SwitchTo().Alert();
            failedupvoteAlert.Accept();
        }
        [Test]
        public void UpVoteCreationOnQuestionAs_GuestTest()
        {
            driver.Url = baseUrl + "questions";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("unauthupvote_arrow")));
            var upvoteButton = driver.FindElement(By.Name("unauthupvote_arrow"));
            upvoteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert failedupvoteAlert = driver.SwitchTo().Alert();
            failedupvoteAlert.Accept();
        }
        [Test]
        public void DownVoteCreationOnQuestionAs_GuestTest()
        {
            driver.Url = baseUrl + "questions";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("unauthdownvote_arrow")));
            var downvoteButton = driver.FindElement(By.Name("unauthdownvote_arrow"));
            downvoteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert failedupvoteAlert = driver.SwitchTo().Alert();
            failedupvoteAlert.Accept();
        }
        [Test]
        public void UpVoteCreationOnCommentAs_GuestTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[1]")));
            var upvoteButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[1]"));
            upvoteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert failedupvoteAlert = driver.SwitchTo().Alert();
            failedupvoteAlert.Accept();
        }
        [Test]
        public void DownVoteCreationOnCommentAs_GuestTest()
        {
            driver.Url = baseUrl + "contents/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[2]")));
            var downvoteButton = driver.FindElement(By.XPath("/html/body/div/div[1]/div[2]/div/div/div[3]/div/div/i[2]"));
            downvoteButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert failedupvoteAlert = driver.SwitchTo().Alert();
            failedupvoteAlert.Accept();
        }
        [TearDown]
        public void TearDown()
        {
            //driver.Quit();
            //SeederHandler.TestSeederTearDown("SeleniumPostActionsTestTearDownSeeder");
        }
    }
}
