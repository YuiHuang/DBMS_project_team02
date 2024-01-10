SELECT * 
FROM user_ingr,ingr 
where user_ingr.ingr_id=ingr.ingr_id and user_ingr.amount > 0