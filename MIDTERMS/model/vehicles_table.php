<?php
    class VehiclesTable {
        /**
         * Returns a collection of all vehicles in the vehicles table
         * @return { Vehicle[] }
         */
        public static function get_vehicles() {
            $db = Database::getDB();
            $query = "SELECT * FROM vehicles ORDER BY price DESC";
            $statement = $db->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor();

            $vehicles = [];
            foreach ($rows as $row) {
                $make = MakesTable::get_make($row['make_id']);
                $type = TypesTable::get_type($row['type_id']);
                $class = ClassesTable::get_class($row['class_id']);
                $vehicle = new Vehicle($make, $type, $class, $row['year'], $row['model'], $row['price']);
                $vehicles[] = $vehicle;
            }

            return $vehicles;
        }

        /**
         * @param {string} $sort_by - ORDER BY clause for SQL query
         * @param {string[]} $filters - Array of key, value pairs for filters selected for SQL WHERE clause
         * @return { Vehicle[] } - An array of vehicle records filtered and sorted
         */
        public static function get_vehicles_filtered($sort_by, $filters) {
            $db = Database::getDB();
            $query = "SELECT * FROM vehicles";

            // Get the array of query expressions for WHERE clause, if any
            $query_array = get_query_expressions($filters);

            // Concat WHERE clause to query, if filters provided
            if (count($query_array) > 0) {
                $query .= ' WHERE ';
                $query .= implode(' AND ', $query_array);
            }

            // ORDER by clause
            $query .= " ORDER BY {$sort_by} DESC";

            $statement = $db->prepare($query);
            $statement->execute();
            $rows = $statement->fetchAll();
            $statement->closeCursor();

            $vehicles = [];
            foreach ($rows as $row) {
                $make = MakesTable::get_make($row['make_id']);
                $type = TypesTable::get_type($row['type_id']);
                $class = ClassesTable::get_class($row['class_id']);
                $vehicle = new Vehicle($make, $type, $class, $row['year'], $row['model'], $row['price']);
                $vehicles[] = $vehicle;
            }

            return $vehicles;
        }

        /**
         * Adds a vehicle to the vehicles table
         *
         * @param {String} $year - Vehicle's year
         * @param {String} $model - Vehicle's model
         * @param {String} $price - Vehicle's price
         * @param {Integer} $make_id - Vehicle's make_id
         * @param {Integer} $type_id - Vehicle's type_id
         * @param {Integer} $class_id - Vehicle's class_id
         * @return {Integer} $count - Count of records affected in database
         */
        public static function add_vehicle($year, $model, $price, $make_id, $type_id, $class_id) {
            $db = Database::getDB();
            $count = 0;

            $query = "INSERT INTO vehicles (year, model, price, make_id, type_id, class_id)
                        VALUES (:year, :model, :price, :make_id, :type_id, :class_id)";

            $statement = $db->prepare($query);
            $statement->bindValue(':year', $year);
            $statement->bindValue(':model', $model);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':make_id', $make_id);
            $statement->bindValue(':type_id', $type_id);
            $statement->bindValue(':class_id', $class_id);
            if ($statement->execute()) {
                $count = $statement->rowCount();
            }
            $statement->closeCursor();
            return $count;
        }

        /**
         * Deletes a vehicle from the vehicles table based on provided
         * year, model, price, {+ make_id, type_id, and class_id }
         *
         * @param {string} $year - Vehicle's year
         * @param {string} $model - Vehicle's model
         * @param {string} $price - Vehicle's price
         * @param {Integer[]} $ids - Associative array for make_id, type_id, class_id
         * @return {Integer} $count - Count of rows affected in database
         */
        public static function delete_vehicle($year, $model, $price, $ids) {
            $db = Database::getDB();
            $count = 0;
            $query = "DELETE FROM vehicles WHERE year = :year AND model = :model AND price = :price";

            // Get the WHERE clause query expressions for provided ids
            $query_array = get_query_expressions($ids);

            // If the vehicle to be deleted has a make_id, type_id, and/or class_id
            // Concatenate to query
            if (count($query_array) > 0) {
                $query .= ' AND ';
                $query .= implode(' AND ', $query_array);
            }

            $query .= ' LIMIT 1';

            $statement = $db->prepare($query);
            $statement->bindValue(':year', $year);
            $statement->bindValue(':model', $model);
            $statement->bindValue(':price', $price);
            if ($statement->execute()) {
                $count = $statement->rowCount();
            }
            $statement->closeCursor();
            return $count;
        }

    }
?>