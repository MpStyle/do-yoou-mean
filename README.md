# Do you mean

It's a library which tries to copy the "do you mean..." functionality of Google search engine in a simple way.
It is based on a dictionary of words.

## Functionality
- Writed to support different languages.
- It uses the Levenshtein distance to propose the suggested words.
- You can extends the library writing your own "do you mean..." version, for example: to use a different database, or a different data model.

## Usages
If you want to use *Do you mean* with MySQL database, you have to execute the content up.sql file in your database.

### API instance
```php
$doYouMeanAPI=new DoYouMean(
    new MySQLRepositoryFactory(
        new PDO('dns', 'username', 'password')
    )
);
```

### Search similar words
```php
$sentence = new SentenceRequest('it', 'ciao');
$result = $doYouMeanAPI->getDoYouMeanBook()->compute($sentence);
```
**NOTICE**: it is necessary to populate the dictionary table, before use this method.

### Populate dictionary table programmatically
The words will be stored in the table stripping the non-alphabetic characters.

##### Add word
```php
$word = new DictionaryWord();
$word->setLanguage('it')
    ->setWord('ciao');
$result = $doYouMeanAPI->getDictionaryBook()->addWord($word);
```

##### Add words
```php
$sentence = new DictionarySentence();
$sentence->setLanguage('it')
    ->setSentence('ciao mondo');
$result = $doYouMeanAPI->getDictionaryBook()->addSentence($sentence);
```

## Testing
It is necessary to create a DB, called *dym_testing_db*, in the localhost MySQL instance:
- Port: **3306**
- User: **root**
- Password: *empty*
- Encode: **utf8**

### Run the unit test
```
composer test
```