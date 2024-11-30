using System;
using System.Collections.Generic;

class ChatBot
{
    
    static Dictionary<string, List<string>> platforms = new Dictionary<string, List<string>>()
    {
        { "Маркетплейсы", new List<string>
            {
                "ozon.ru", "wildberries.ru", "yandex.market",
                "aliexpress.ru", "goods.ru", "lamoda.ru",
                "mvideo.ru"
            }
        },
        { "Объявления", new List<string>
            {
                "avito.ru", "youla.ru", "drom.ru", "auto.ru"
            }
        },
        { "Интернет-магазины", new List<string>
            {
                "mvideo.ru", "technopark.ru", "sbermegamarket.ru", "eldorado.ru"
            }
        },
        { "Фриланс", new List<string>
            {
                "freelancer.com", "upwork.com", "workzilla.com", "fl.ru"
            }
        }
    };

   
    static void Main(string[] args)
    {
        Console.WriteLine("Привет! Я чат-бот. Как я могу помочь?");
        Console.WriteLine("Если вам нужна информация о парсинге, напишите 'парсинг'.");
        Console.WriteLine("Если вам нужно получить список площадок, напишите 'площадки'.");
        Console.WriteLine("Для выхода напишите 'выход'.");

        bool isRunning = true;

        while (isRunning)
        {
            string userInput = Console.ReadLine().ToLower(); 

            if (userInput == "выход")
            {
                isRunning = false;
                Console.WriteLine("До свидания!");
            }
            else if (userInput == "парсинг")
            {
                ProvideParsingInfo();
            }
            else if (userInput == "площадки")
            {
                ListPlatforms();
            }
            else
            {
                Console.WriteLine("Я не понимаю ваш запрос. Попробуйте снова.");
            }
        }
    }
    static void ProvideParsingInfo()
    {
        Console.WriteLine("Парсинг — это процесс автоматического извлечения данных с веб-сайтов. Для парсинга обычно используют такие технологии, как:");
        Console.WriteLine("- HTML-парсинг с использованием библиотеки BeautifulSoup (Python) или HtmlAgilityPack (C#).");
        Console.WriteLine("- Использование API (если оно доступно на сайте).");
        Console.WriteLine("- Использование Selenium для взаимодействия с динамическими веб-страницами.");
        Console.WriteLine("\nПарсинг может быть полезен для анализа цен, сбора данных о товарах, новостях, информации о пользователях и многом другом.");
    }


    static void ListPlatforms()
    {
        Console.WriteLine("Вот список площадок, разделенных по категориям:");

        foreach (var category in platforms)
        {
            Console.WriteLine($"\n{category.Key}:");
            foreach (var platform in category.Value)
            {
                Console.WriteLine($"- {platform}");
            }
        }
    }
}
