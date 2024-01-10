UPDATE user_ingr
SET amount = 'input_amount'
WHERE ingr_id = (
    SELECT ingr_id
    FROM ingr
    WHERE ingr_name = 'input_ingr_name');

'''
UPDATE user_ingr
SET amount = 1
WHERE ingr_id = 38
'''