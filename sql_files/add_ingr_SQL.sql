UPDATE user_ingr
SET amount = amount + 1
WHERE ingr_id = (
    SELECT ingr_id
    FROM ingr
    WHERE ingr_name = 'input_ingr_name');