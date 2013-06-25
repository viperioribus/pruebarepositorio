<h1>Vista del Autor</h1>
<table>
<tr height="40px" width="100px">
<td><?php echo 'Id:';?></td>
<td><?php echo $autors['Autor']['id'];?></td></tr>
</table>
<ul>
<li><?php echo $html->link('EditarAutor',
'/autors/edit/'.$autors['Autor']['id']) ?></li>
</ul>