<?php

$lang['db_invalid_connection_str'] = 'Tietokannan asetuksia ei voida määrittää annetun yhteystiedon perusteella.'; //  'Unable to determine the database settings based on the connection string you submitted.'
$lang['db_unable_to_connect'] = 'Tietokantaan ei voida yhdistää annetuilla asetuksilla.'; //  Unable to connect to your database server using the provided settings.'
$lang['db_unable_to_select'] = 'Määritettyä tietokantaa ei voida valita: %s'; //   'Unable to select the specified database: %s'
$lang['db_unable_to_create'] = 'Määritettyä tietokantaa ei voida luoda: %s'; // 'Unable to create the specified database: %s'
$lang['db_invalid_query'] = 'Lähetetty kysely on väärin muodostettu. ' ; // 'The query you submitted is not valid.'
$lang['db_must_set_table'] = 'Sinun täytyy asettaa tietokantataulu, jota käytetään kyselyssä. '; //  'You must set the database table to be used with your query.'
$lang['db_must_use_set'] = 'Sinun täytyy käyttää "set"-metodia päivittääksesi tietueen. '; // 'You must use the "set" method to update an entry.'
$lang['db_must_use_index'] = 'Sinun täytyy määrittää täsmäävä indeksi sarjapäivitykselle. '; // 'You must specify an index to match on for batch updates.'
$lang['db_batch_missing_index'] = 'Yhdestä tai useammasta joukkopäivityksen rivistä puuttuu tarvittava indeksi. '; // 'One or more rows submitted for batch updating is missing the specified index.'
$lang['db_must_use_where'] = 'Päivityksiä ei hyväksytä mikäli niistä puuttuu "where"-sääntö. '; // 'Updates are not allowed unless they contain a "where" clause.'
$lang['db_del_must_use_where'] = 'Poistamisia ei hyväksytä mikäli niistä puuttuu "where"- tai "like"-sääntö. '; // 'Deletes are not allowed unless they contain a "where" or "like" clause.'
$lang['db_field_param_missing'] = 'Tietueiden hakeminen vaatii taulun nimen parametriksi. '; // 'To fetch fields requires the name of the table as a parameter.'
$lang['db_unsupported_function'] = 'Tämä ominaisuus ei ole käytettävissä käytössä olevassa tietokannassa.'; // 'This feature is not available for the database you are using.'
$lang['db_transaction_failure'] = 'Tiedonsiirtovirhe: Tila palautettu aikaisempaan tilanteeseen.' ; // 'Transaction failure: Rollback performed.'
$lang['db_unable_to_drop'] = 'Määritettyä tietokantaa ei voida poistaa. '; // 'Unable to drop the specified database.'
$lang['db_unsuported_feature'] ='Tämä ominaisuus ei ole tuettu käytössä olevassa tietokanta-alustassa. '; //  'Unsupported feature of the database platform you are using.'
$lang['db_unsuported_compression'] = 'Tiedostonpakkausformaatti ei ole tuettu palvelimessasi. '; // 'The file compression format you chose is not supported by your server.'
$lang['db_filepath_error'] = 'Tietoa ei voida kirjoittaa annettuun tiedostopolkuun. '; // 'Unable to write data to the file path you have submitted.'
$lang['db_invalid_cache_path'] = 'Annettu välimuistin polku ei ole käytössä tai kohteeseen ei ole kirjoitusoikeuksia.'; // 'The cache path you submitted is not valid or writable.'
$lang['db_table_name_required'] = 'Taulun nimi vaaditaan kyseiseen operaatioon.'; // 'A table name is required for that operation.'
$lang['db_column_name_required'] = 'Sarakkeen nimi vaaditaan kyseiseen operaatioon. '; // 'A column name is required for that operation.'
$lang['db_column_definition_required'] = 'Sarakkeen määritelmä vaaditaan kyseiseen operaatioon.'; // 'A column definition is required for that operation.'
$lang['db_unable_to_set_charset'] = 'Ei voida asettaa asiakkaan merkistökoodausta: %s'; // 'Unable to set client connection character set: %s'
$lang['db_error_heading'] = 'Tietokantavirhe'; // 'A Database Error Occurred'

/* End of file db_lang.php */
/* Location: ./system/language/english/db_lang.php */
