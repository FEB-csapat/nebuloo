using System;
using System.Collections.Generic;
using System.Diagnostics;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace NebulooWebTest
{
    public static class SeederHandler
    {
        public static void TestSeederSetUp(string filename)
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class="+filename;
            process.Start();
            process.WaitForExit();
        }
        public static void TestSeederTearDown(string filename)
        {
            Process process = new Process();
            process.StartInfo.WindowStyle = ProcessWindowStyle.Normal;
            process.StartInfo.FileName = "cmd.exe";
            process.StartInfo.WorkingDirectory = Path.GetFullPath("../../../../../../nebuloo");
            process.StartInfo.Arguments = "/C docker compose exec app php artisan db:seed --class=" + filename;
            process.Start();
            process.WaitForExit();
        }
    }
}
