<?php
/**
 * Created by PhpStorm.
 * User: leona
 * Date: 5.3.2019.
 * Time: 13:08
 */
require_once ('../../private/initialize.php');

$sql = 'SELECT username, email FROM users';
$result = $database->query($sql);
$all = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<table>
<?php while ($row = $result->fetch()) { ?>
    <tr>
        <td><?php echo $row['username']; ?></td>
        <td><?php echo $row['email']; ?></td>
    </tr>
<?php } ?>
</table>
<pre>

<?php print_r($all); ?>
</pre>
