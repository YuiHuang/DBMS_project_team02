target_id = 
SELECT ingr_id
FROM ingr
WHERE ingr_name = 'input_ingr_name';

DELETE 
FROM user_ingr 
WHERE ingr_id = target_id;

INSERT INTO `user_ingr` (`user_id`, `ingr_id`, `amount`) 
VALUES (0, ingr_id, 'input_amount');

'''
UPDATE user_ingr
SET amount = "input_amount"
WHERE ingr_id = (
    SELECT ingr_id
    FROM ingr
    WHERE ingr_name = "input_ingr_name");
'''

'''
UPDATE user_ingr
SET amount = 1
WHERE ingr_id = 38
'''