# File Data Validator

A plugin that can check if files like csv or excel is in proper data format.

USAGE:
use Chasj\FileDataValidator\Service\Runner;

$runner = new Runner();
if ($runner->valid()) {
    echo "All data are in valid format";
}

Sample JSON setting
{
    "id": {
        "type": "number",
        "required": true
    },
    "type": {
        "type": "string",
        "required": true,
        "enum": ["test", "test2"]
    }
}


Limitations:
- Can only read csv file for now
- json filename should be the same as that of the data file like input.csv and input.json

Tests:
To follow
