using OpenQA.Selenium.Chrome;
using OpenQA.Selenium;
using WebDriverManager;
using WebDriverManager.DriverConfigs.Impl;
using OpenQA.Selenium.Support.UI;

namespace NebulooWebTest
{
    public class QuestionTest
    {
        IWebDriver driver;
        static string baseUrl = "http://localhost:8881/";
        WebDriverWait wait;
        [SetUp]
        public void Setup()
        {
            SeederHandler.TestSeederSetUp("SeleniumQuestionTestSeeder");
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
            driver.Url = baseUrl + "questions";
        }
        [Test]
        public void QuestionCreationTest()
        {            
            var questioncreationButton = driver.FindElement(By.ClassName("fab-button"));
            questioncreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions/create"));
            var questiontitleTextArea = driver.FindElement(By.Name("cim"));
            questiontitleTextArea.SendKeys("Test title");

            var questionbodyTextArea = driver.FindElement(By.Name("leiras"));
            questionbodyTextArea.SendKeys("Test question");

            var submitButtonQuestion = driver.FindElement(By.Name("createquestion"));
            submitButtonQuestion.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions/"));

        }
        [Test]
        public void QuestionCreationWithoutBodyTest()
        {
            var questioncreationButton = driver.FindElement(By.ClassName("fab-button"));
            questioncreationButton.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions/create"));

            var submitButtonQuestion = driver.FindElement(By.Name("createquestion"));
            submitButtonQuestion.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.AlertIsPresent());
            IAlert nobodyAlert = driver.SwitchTo().Alert();
            nobodyAlert.Accept();
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
        public void QuestionUpdateWithoutBodyTest()
        {
            driver.Url = baseUrl + "questions/1";
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("detailedquestiontags")));
            var questionupdateButton = driver.FindElement(By.Name("questionupdate"));
            questionupdateButton.Click();

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("questionupdatetagselector")));
            var questionbodyTextArea = driver.FindElement(By.Name("leiras"));
            for (int i = 0; i < 255; i++)
            {
                questionbodyTextArea.SendKeys(Keys.Backspace);
            }

            var savequestionupdateButton = driver.FindElement(By.Name("questionupdatesave"));
            savequestionupdateButton.Click();

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

            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "me"));
        }
        [Test]
        public void QuestionShowTest()
        {
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.ElementExists(By.Name("questioncard")));
            var questionCard = driver.FindElement(By.Name("questioncard"));
            questionCard.Click();
            wait.Until(SeleniumExtras.WaitHelpers.ExpectedConditions.UrlContains(baseUrl + "questions/1"));
        }
        [TearDown]
        public void TearDown()
        {
            SeederHandler.TestSeederTearDown("SeleniumQuestionTestTearDownSeeder");
            driver.Quit();
        }
    }
}
