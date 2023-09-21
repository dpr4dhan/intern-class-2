<?php

require __DIR__ . '/vendor/autoload.php';

require('./utils/helper.php');
require('./app/Db.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//print_r(getenv('DB_HOST'));die;


$db = new Db;
/*
$stmt = $db->createStatement("INSERT INTO PERSONS (name, mobile, email, created_on, updated_on) VALUES (?, ?, ?, ?, ?)");


$types = "sssss";
$valueArr = [
    'AnishM',
    '9811111111',
    'anish@yopmail.com',
    date('Y-m-d H:i:s'),
    date('Y-m-d H:i:s')
];

$db->bindValues($types, $valueArr);
$result = $db->execute();
*/


$persons = $db->createStatement("SELECT * from PERSONS ")
//            ->bindValues('s', ['dp@yopmail.com'])
            ->execute()
            ->getResult();

?>
<form method="post" action="">
    <label for="email">
        Filter
        <input type="text" name="email">
    </label>
    <button type="submit">Submit</button>
</form>


<table style="border: 1px solid;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
        </tr>
    </thead>
    <tbody>
        <?php if(count($persons) > 0): ?>
            <?php foreach($persons as $person):?>
                <tr>
                    <td><?php echo $person['name'] ?></td>
                    <td><?php echo $person['email'] ?></td>
                    <td><?php echo $person['mobile'] ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="3">No data found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

