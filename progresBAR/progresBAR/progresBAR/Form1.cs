using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace progresBAR
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        int sn = 0;
        int dk = 0;
        int saat = 0;
        private void Form1_Load(object sender, EventArgs e)
        {
            textBox3.Text = sn.ToString();
            textBox2.Text = dk.ToString();
            textBox1.Text = saat.ToString();
        }
        private void button1_Click(object sender, EventArgs e)
        {
            sn++;
            if (sn == 60)
            {
                sn = 0;
                dk++;
            }
            if (dk == 60)
            {
                sn = 0;
                dk = 0;
                saat++;
            }
            if (saat == 24)
            {
                sn = 0;
                dk = 0;
                saat = 0;
            }

            textBox3.Text = sn.ToString();
            textBox2.Text = dk.ToString();
            textBox1.Text = saat.ToString();
        }

        private void timer1_Tick(object sender, EventArgs e)
        {
            sn++;
            if (sn == 60)
            {
                sn = 0;
                dk++;
            }
            if (dk == 60)
            {
                sn = 0;
                dk = 0;
                saat++;
            }
            if (saat == 24)
            {
                sn = 0;
                dk = 0;
                saat = 0;
            }

            textBox3.Text = sn.ToString();
            progressBar3.Value = sn;

            textBox2.Text = dk.ToString();
            progressBar2.Value = dk;

            textBox1.Text = saat.ToString();
            progressBar1.Value = saat;

        }

        private void button2_Click(object sender, EventArgs e)
        {
            timer1.Enabled = true;
        }

        private void button3_Click(object sender, EventArgs e)
        {
            timer1.Enabled = false;
        }
    }
}

