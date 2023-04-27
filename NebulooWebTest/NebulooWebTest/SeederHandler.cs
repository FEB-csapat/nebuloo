using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace NebulooWebTest
{
    public  class SeederHandler
    {
        public void RegistrationSeederSetUp()
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class=SeleniumRegistrationTestSeeder";
            process.Start();
            process.WaitForExit();
        }
        public void ContentSeederSetUp()
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class=SeleniumContentTest_1_Seeder";
            process.Start();
            process.WaitForExit();
        }

        public void ContentSeederTearDown()
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class=ReverseSeleniumContentTest_1_Seeder";
            process.Start();
            process.WaitForExit();
        }

        public void LoginSeederSetUp()
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class=SeleniumLoginTestSeeder";
            process.Start();
            process.WaitForExit();
        }

        public void LoginSeederTearDown()
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class=SeleniumLoginTestTearDownSeeder";
            process.Start();
            process.WaitForExit();
        }
    }
}
