BEGIN
    INSERT INTO user_back_up (email,password)
    VALUES (NEW.email,new.password); 
END
