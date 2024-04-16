<?php


namespace models;


class CardAccount extends CoreModel
{

    protected function setNameTable(): string
    {
        return 'card_account';
    }

    public function getAll()
    {
        return $this->db->query(sprintf('SELECT * FROM %s', $this->setNameTable()))->row_array();
    }


    public function query($query): void
    {
        $this->setType('pdo');
        $this->db->execTransaction($query);

        $this->setType('postgres');
        $this->db->execTransaction($query);
    }

    public function getAllDb(): array
    {
        $this->setType('pdo_postgres');
        $postgres = $this->getAll();
        $this->setType('pdo');
        $mysql = $this->getAll();

        return ['postgres' => $postgres, 'mysql' => $mysql];
    }


//    public function transferMoney(int $number_to, int $number_from, float|int $sum)
//    {
//
//        $this->setType('pdo');
//
//        $sql = sprintf('UPDATE %s SET balance = CASE WHEN balance - :sum < 0 THEN balance ELSE balance - :sum END WHERE number = :number ',$this->setNameTable());
//
//        $this->db->execTransaction($sql, [
//            ':sum' => $sum,
//            ':number' => $number_from,
//        ]);
//    }
}