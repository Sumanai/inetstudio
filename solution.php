<?php

const DATA_ARRAY = [
    ['id' => 1, 'date' => '12.01.2020', 'name' => 'test1'],
    ['id' => 2, 'date' => '02.05.2020', 'name' => 'test2'],
    ['id' => 4, 'date' => '08.03.2020', 'name' => 'test4'],
    ['id' => 1, 'date' => '22.01.2020', 'name' => 'test1'],
    ['id' => 2, 'date' => '11.11.2020', 'name' => 'test4'],
    ['id' => 3, 'date' => '06.06.2020', 'name' => 'test3'],
];

printResult('Unique values', findUniqueById(DATA_ARRAY));
printResult('Array sorted by name key', sortByKeyName(DATA_ARRAY, 'name'));
printResult('Array filtered by id = 1', filterByKeyName(DATA_ARRAY, 'id', 1));
printResult('Array name => id', keyByName(DATA_ARRAY));

function printResult(string $message, array $result): void
{
    echo "{$message}:\n";
    echo json_encode($result, JSON_PRETTY_PRINT);
    echo "\n\n";
}

function findUniqueById(array $data): array
{
    return array_values(array_combine(array_column($data, 'id'), $data));
}

function sortByKeyName(array $data, string $key): array
{
    usort($data, function (array $a, array $b) use ($key) {
        return $a[$key] <=> $b[$key];
    });

    return array_values($data);
}

function filterByKeyName(array $data, string $column, string|int $value): array
{
    $filteredArray = array_filter($data, function (array $line) use ($column, $value) {
        return $line[$column] === $value;
    });

    return array_values($filteredArray);
}

function keyByName(array $data): array
{
    return array_column($data, 'id', 'name');
}
