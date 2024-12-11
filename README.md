# Svátky Vanio

### Nově dostupné na 
https://svatky.steelants.cz/api/

## POZOR! Provoz API bude ke konci roku 2024 ukončen!

Od nového roku již nebudu mít kapacitu se o provoz API starat, proto prosím o pochopení, že jeho provoz nejpozději k 31. 12. 2024 skončí.
Budete-li někdo ochotní spustit vlastní instanci, vytvořte prosím PR s úpravou tohoto README s novou URL, na které API poběží.

Díky moc za podporu a pochopení.

Stanislav Kocanda, autor

## Veřejné API s informací o českých státních svátcích

Toto API je možné využít bez omezení, jeho použití je zcela zdarma, nicméně jeho fungování je bez záruky.

API pro vás připravilo [Vanio](http://www.vanio.cz). Staráme se o to, aby API dobře fungovalo, v případě potíží nám napište na [mail](mailto:info@vanio.cz).

## Způsob použití

1. Pro konkrétní datum:
```http
GET https://svatky.vanio.cz/api/yyyy-mm-dd
```
2. Pro dnešní den
```http
GET https://svatky.vanio.cz/api/
```

## Struktura odpovědi

Odpověď serveru obsahuje tyto pole:

* *date* (string): Datum ve formátu yyyy-mm-dd
* *month* (array): Český název měsíce
    * *nominative* (string): v prvním pádě
    * *genitive* (string): ve druhém pádě
* *dow* (string): Český název dne v týdnu
* *name* (string): Jméno, které slaví svátek
* *isPublicHoliday* (boolean): Zda je dané datum státním svátkem
* *holidayName* (string): Pouze, pokud je dané datum státním svátkem, název státního svátku
* *shopsClosed* (boolean|string): Pouze, pokud je dané datum státním svátkem. Informace, zda jsou podle zákona zavřené obchody. V případě 24.12. je hodnota string ("po 12. hodině"), u ostatních svátků je hodnota boolean.

## Podporované formáty:

1. **JSON**

    V požadavku
    ```
    Accept: application/json
    ```
    Ukázka odpovědi:
    ```json
    {
        "date":"2018-12-24",
        "month":{
            "nominative":"prosinec",
            "genitive":"prosince"
        },
        "dow":"pond\u011bl\u00ed",
        "name":"Adam a Eva",
        "isPublicHoliday":true,
        "holidayName":"\u0160t\u011bdr\u00fd den",
        "shopsClosed":"po 12. hodin\u011b"
    }
    ```
2. **HTML**

    V požadavku
    ```
    Accept: text/html
    ```
    Ukázka odpovědi:
    ```html
    <html>
        <head>
            <meta charset="utf-8">
        </head>
        <body>
            <dl>
                <dt>date</dt><dd>2018-12-24</dd>
                <dt>month nominative</dt><dd>prosinec</dd>
                <dt>month genitive</dt><dd>prosince</dd>
                <dt>dow</dt><dd>pondělí</dd>
                <dt>name</dt><dd>Adam a Eva</dd>
                <dt>isPublicHoliday</dt><dd>1</dd>
                <dt>holidayName</dt><dd>Štědrý den</dd>
                <dt>shopsClosed</dt><dd>po 12. hodině</dd>
            </dl>
        </body>
    </html>
    ```
3. **Prostý text v UTF8 - v ostatních případech**

    Ukázka odpovědi:
    ```
    date: 2018-12-24
    month nominative: prosinec
    month genitive: prosince
    dow: pondělí
    name: Adam a Eva
    isPublicHoliday: 1
    holidayName: Štědrý den
    shopsClosed: po 12. hodině
    ```
